<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Contents\News;

use App\Models\ContentType;
use App\Models\News;
use App\Models\User;
use App\Orchid\Layouts\Contents\News\NewsEditLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Illuminate\Support\Str;
use Google_Service_YouTube;
use Google_Client;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class NewsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'news' => News::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'News';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All news';
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
                ->modal('NewsModal')
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
            'platform.systems.news',
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
            Layout::table('news', [
                TD::make('name', __('Name'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(fn (News $news) => ModalToggle::make($news->name)
                        ->modal('asyncEditNewsModal')
                        ->modalTitle($news->presenter()->title())
                        ->method('createOrUpdate')
                        ->asyncParameters([
                            'news' => $news->id,
                        ])),

                TD::make(__('Image'))
                    ->render(function (News $news) {
                        return '<img src="' . $news->image . '" width="100">';
                    }),

                TD::make('is_highlight', __('Highlight News'))
                    ->sort()
                    ->render(fn (News $news) => $news->is_highlight ? '<i class="text-success">●</i> True'
                        : '<i class="text-danger">●</i> False'),

                TD::make('attr_1', __('Duration'))
                    ->sort()
                    ->render(fn (News $news) => $news->attr_1),

                TD::make('type', __('Category'))
                    ->sort()
                    ->render(fn (News $news) => $news['parent']->name),

                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(fn (News $news) => $news->updated_at),

                TD::make('Actions')
                    ->render(function (News $news) {
                        return Button::make('Delete')
                            ->confirm('After deleting, the News will be gone forever.')
                            ->method('delete', ['news' => $news->id]);
                    }),
            ]),
            Layout::modal('NewsModal', Layout::rows([
                Relation::make('news.author')
                    ->title('Author')
                    ->required()
                    ->fromModel(User::class, 'name'),

                Relation::make('news.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->fromModel(ContentType::class, 'name')->applyScope('content'),

                Input::make('news.source')
                    ->title('Youtube URL')
                    ->placeholder('Share youtube id video on your News')
                    ->help('Specify a short descriptive title for this news.'),

                Group::make([
                    Switcher::make('news.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Highlight News'),

                    Switcher::make('news.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Status'),
                ]),
            ]))
                ->title('Create News')
                ->applyButton('Add News'),

            Layout::modal('asyncEditNewsModal', NewsEditLayout::class)
                ->async('asyncGetNews'),
        ];
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetNews(News $news): iterable
    {
        return [
            'news' => $news,
        ];
    }

    /**
     * @param Request $request
     * @param News    $news
     */
    public function createOrUpdate(Request $request, News $news): void
    {
        $request->validate([
            'news.source' => [
                'required'
            ],
        ]);

        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $data = $request->input('news');

        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $data['source'], $matches);
        $youtubeId = $matches[1];

        $videoResponse = $youtube->videos->listVideos('snippet, contentDetails', array(
            'id' => $youtubeId
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
            'image' => isset($video['snippet']['thumbnails']['maxres']['url']) ?
                $video['snippet']['thumbnails']['maxres']['url'] :
                $video['snippet']['thumbnails']['standard']['url'],
            'is_highlight' => $data['is_highlight'],
            'active' => $data['active'],
        );

        $news->fill($create)->save();

        Toast::info(__('News was saved.'));
    }

    /**
     * @param News $news
     *
     * @return void
     */
    public function delete(News $news)
    {
        $news->delete();
    }
}
