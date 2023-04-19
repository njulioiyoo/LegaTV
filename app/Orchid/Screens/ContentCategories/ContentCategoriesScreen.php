<?php

namespace App\Orchid\Screens\ContentCategories;

use App\Models\ContentCategories;
use App\Orchid\Layouts\ContentCategories\EditLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Toast;


class ContentCategoriesScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'ContentCategories' => ContentCategories::whereIn('type', ['contents', 'vod'])->latest()->get(),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Content Categories';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Content Categories is a categorization of content topics such as politics, business, technology, sports, entertainment, and others, making it easier for readers to find content that suits their interests, and for media to present content in a structured manner.';
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
                ->modal('ContentCategoriesModal')
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
            'platform.systems.content_categories',
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
            Layout::table('ContentCategories', [
                TD::make('name', __('Name'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(fn (ContentCategories $contentCategories) => ModalToggle::make($contentCategories->name)
                        ->modal('asyncEditContentCategoriesModal')
                        ->modalTitle($contentCategories->presenter()->title())
                        ->method('createOrUpdate')
                        ->asyncParameters([
                            'contentCategories' => $contentCategories->id,
                        ])),

                TD::make('type', __('Type'))
                    ->sort()
                    ->render(fn (ContentCategories $contentCategories) => $contentCategories->type),

                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(fn (ContentCategories $contentCategories) => $contentCategories->updated_at),

                TD::make('Actions')
                    ->render(function (ContentCategories $contentCategories) {
                        return Button::make('Delete')
                            ->confirm('After deleting, the Content Categories will be gone forever.')
                            ->method('delete', ['ContentCategories' => $contentCategories->id]);
                    }),
            ]),
            Layout::modal('ContentCategoriesModal', Layout::rows([
                Select::make('contentCategories.type')
                    ->options([
                        'contents'  => 'Contents',
                        'vod'       => 'Video On Demand',
                    ])
                    ->title('Select type')
                    ->help('Allow search bots to index'),
                Input::make('contentCategories.name')
                    ->title('Name')
                    ->placeholder('Enter Content Categories name')
                    ->help('The name of the Content Categories to be created.'),
            ]))
                ->title('Create Content Categories')
                ->applyButton('Add Content Categories'),

            Layout::modal('asyncEditContentCategoriesModal', EditLayout::class)
                ->async('asyncGetContentCategories'),
        ];
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetContentCategories(ContentCategories $contentCategories): iterable
    {
        return [
            'contentCategories' => $contentCategories,
        ];
    }

    /**
     * @param Request $request
     * @param ContentCategories    $contentCategories
     */
    public function createOrUpdate(Request $request, ContentCategories $contentCategories): void
    {
        $request->validate([
            'contentCategories.name' => [
                'required'
            ],
        ]);

        $contentCategories->fill($request->input('contentCategories'))->save();

        Toast::info(__('Content Categories was saved.'));
    }

    /**
     * @param ContentCategories $contentCategories
     *
     * @return void
     */
    public function delete(ContentCategories $contentCategories)
    {
        $contentCategories->delete();
    }
}
