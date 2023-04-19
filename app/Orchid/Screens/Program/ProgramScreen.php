<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Program;

use App\Models\ContentCategories;
use App\Models\Program;
use App\Models\User;
use App\Orchid\Layouts\Program\ProgramEditLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Illuminate\Support\Str;
use Orchid\Screen\TD;
use Google_Service_YouTube;
use Google_Client;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;

class ProgramScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'program' => Program::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Program';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All programs';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add')
                ->modal('ProgramModal')
                ->method('createOrUpdate')
                ->icon('plus'),
        ];
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.program',
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('program', [
                TD::make('name', __('Name'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(fn (Program $program) => ModalToggle::make($program->name)
                        ->modal('asyncEditProgramModal')
                        ->modalTitle($program->presenter()->title())
                        ->method('createOrUpdate')
                        ->asyncParameters([
                            'program' => $program->id,
                        ])),

                TD::make('attr_1', __('Duration'))
                    ->sort()
                    ->render(fn (Program $program) => $program->attr_1),

                TD::make('type', __('Category'))
                    ->sort()
                    ->render(fn (Program $program) => $program['parent']->name),

                TD::make('is_shared_to_live', __('Shared to Live TV'))
                    ->sort()
                    ->render(fn (Program $program) => $program->is_shared_to_live ? '<i class="text-success">●</i> True'
                        : '<i class="text-danger">●</i> False'),

                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(fn (Program $program) => $program->updated_at),

                TD::make('Actions')
                    ->render(function (Program $program) {
                        return Button::make('Delete')
                            ->confirm('After deleting, the Program will be gone forever.')
                            ->method('delete', ['program' => $program->id]);
                    }),
            ]),
            Layout::modal('ProgramModal', Layout::rows([
                Relation::make('program.author')
                    ->title('Author')
                    ->required()
                    ->fromModel(User::class, 'name'),

                Relation::make('program.parent_id')
                    ->title('Program')
                    ->required()
                    ->fromModel(ContentCategories::class, 'name')->applyScope('vod'),

                Input::make('program.source')
                    ->title('Youtube ID')
                    ->placeholder('Share youtube id video on your program')
                    ->help('Specify a short descriptive title for this program.'),

                Group::make([
                    Switcher::make('program.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->placeholder('Event for free')
                        ->help('Event for free')
                        ->title('Status'),

                    Switcher::make('program.is_shared_to_live')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_LEFT)
                        ->placeholder('Event for free')
                        ->help('Event for free')
                        ->title('Share to Live TV'),
                ]),
            ]))
                ->title('Create Program')
                ->applyButton('Add Program'),

            Layout::modal('asyncEditProgramModal', ProgramEditLayout::class)
                ->async('asyncGetProgram'),
        ];
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetProgram(Program $program): iterable
    {
        return [
            'program' => $program,
        ];
    }

    /**
     * @param Request $request
     * @param Program    $program
     */
    public function createOrUpdate(Request $request, Program $program): void
    {
        $request->validate([
            'program.source' => [
                'required'
            ],
        ]);

        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $data = $request->input('program');
        $videoResponse = $youtube->videos->listVideos('snippet, contentDetails', array(
            'id' => $data['source']
        ));
        $video = $videoResponse[0];
        $duration = $video->getContentDetails()->getDuration(); //durasi dalam format ISO 8601

        preg_match('/PT(\d+H)?(\d+M)?(\d+S)?/', $duration, $matches);
        $hours = isset($matches[1]) ? intval(str_replace('H', '', $matches[1])) : 0;
        $minutes = isset($matches[2]) ? intval(str_replace('M', '', $matches[2])) : 0;
        $seconds = isset($matches[3]) ? intval(str_replace('S', '', $matches[3])) : 0;
        $totalSeconds = $hours * 3600 + $minutes * 60 + $seconds;
        $formattedDuration = gmdate("i:s", $totalSeconds); // format to "mm:ss"

        $create = array(
            'author' => $data['author'],
            'parent_id' => $data['parent_id'],
            'source' => $data['source'],
            'name' => $video['snippet']['title'],
            'slug' => Str::slug($video['snippet']['title']),
            'body' => $video['snippet']['description'],
            'attr_1' => $formattedDuration,
            'image' => $video['snippet']['thumbnails']['default']['url'],
            'is_shared_to_live' => $data['is_shared_to_live'],
            'active' => $data['active'],
        );


        $program->fill($create)->save();

        Toast::info(__('Program was saved.'));
    }

    /**
     * @param Program $program
     *
     * @return void
     */
    public function delete(Program $program)
    {
        $program->delete();
    }
}
