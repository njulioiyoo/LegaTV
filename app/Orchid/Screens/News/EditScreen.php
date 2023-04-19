<?php

declare(strict_types=1);

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Models\ContentCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Quill;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\Switcher;

class EditScreen extends Screen
{
    /**
     * @var News
     */
    public $news;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param News $news
     *
     * @return array
     */
    public function query(News $news): array
    {
        $news->load('attachment');

        return [
            'news' => $news
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->news->exists ? 'Edit News' : 'Creating a New News';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Blog news";
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
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the news is deleted, all of its resources and data will be permanently deleted. Before deleting your news, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->news->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([
                Relation::make('news.author')
                    ->title('Author')
                    ->required()
                    ->horizontal()
                    ->fromModel(User::class, 'name'),

                Relation::make('news.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentCategories::class, 'name')->applyScope('content'),

                Input::make('news.name')
                    ->title('Title')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this news.'),

                Cropper::make('news.image')
                    ->title('Image')
                    ->required()
                    ->width(1000)
                    ->height(476)
                    ->keepAspectRatio()
                    ->horizontal(),

                Input::make('news.source')
                    ->title('URLs')
                    ->horizontal()
                    ->type('url')
                    ->placeholder('Share url video on your news')
                    ->help('Specify a short descriptive title for this news.'),

                TextArea::make('news.description')
                    ->title('Description')
                    ->horizontal()
                    ->required()
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Quill::make('news.body')
                    ->horizontal()
                    ->required()
                    ->title('Main text'),

                Switcher::make('news.active')
                    ->sendTrueOrFalse()
                    ->title('Status')
                    ->horizontal()
            ])

        ];
    }

    /**
     * @param News    $news
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(News $news, Request $request)
    {
        $data = $request->get('news');
        $data['slug']   = Str::slug($data['name']);
        $data['image']  = url('public' . $data['image']);

        $news->fill($data)->save();

        Toast::info(__('News was saved.'));

        return redirect()->route('platform.systems.news');
    }

    /**
     * @param News $news
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(News $news)
    {
        $news->delete();

        Toast::info(__('News was removed'));

        return redirect()->route('platform.systems.news');
    }
}
