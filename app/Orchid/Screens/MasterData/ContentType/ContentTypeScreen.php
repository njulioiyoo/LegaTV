<?php

namespace App\Orchid\Screens\MasterData\ContentType;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Layouts\MasterData\ContentType\ContentTypeEditLayout;


class ContentTypeScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'ContentType' => ContentType::whereIn('type', ['contents', 'vod'])->latest()->paginate(10),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Content Type';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Content Type is a categorization of content topics such as politics, business, technology, sports, entertainment, and others, making it easier for readers to find content that suits their interests, and for media to present content in a structured manner.';
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
                ->modal('ContentTypeModal')
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
            'platform.systems.content_type',
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('ContentType', [
                TD::make('name', __('Name'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(fn (ContentType $contentType) => ModalToggle::make($contentType->name)
                        ->modal('asyncEditContentTypeModal')
                        ->modalTitle($contentType->presenter()->title())
                        ->method('createOrUpdate')
                        ->asyncParameters([
                            'contentType' => $contentType->id,
                        ])),

                TD::make('type', __('Type'))
                    ->sort()
                    ->render(fn (ContentType $contentType) => $contentType->type),

                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(fn (ContentType $contentType) => $contentType->updated_at),

                TD::make('Actions')
                    ->render(function (ContentType $contentType) {
                        return Button::make('Delete')
                            ->confirm('After deleting, the Content Type will be gone forever.')
                            ->method('delete', ['ContentType' => $contentType->id]);
                    }),
            ]),
            Layout::modal('ContentTypeModal', Layout::rows([
                Select::make('contentType.type')
                    ->options([
                        'contents'  => 'Contents',
                        'vod'       => 'Video On Demand',
                    ])
                    ->title('Select type')
                    ->help('Allow search bots to index'),
                Input::make('contentType.name')
                    ->title('Name')
                    ->placeholder('Enter Content Type name')
                    ->help('The name of the Content Type to be created.'),
            ]))
                ->title('Create Content Type')
                ->applyButton('Add Content Type'),

            Layout::modal('asyncEditContentTypeModal', ContentTypeEditLayout::class)
                ->async('asyncGetContentType'),
        ];
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetContentType(ContentType $contentType): iterable
    {
        return [
            'contentType' => $contentType,
        ];
    }

    /**
     * @param Request $request
     * @param ContentType    $contentType
     */
    public function createOrUpdate(Request $request, ContentType $contentType): void
    {
        $request->validate([
            'contentType.name' => [
                'required'
            ],
        ]);

        $contentType->fill($request->input('contentType'))->save();

        Toast::info(__('Content Type was saved.'));
    }

    /**
     * @param ContentType $contentType
     *
     * @return void
     */
    public function delete(ContentType $contentType)
    {
        $contentType->delete();
    }
}
