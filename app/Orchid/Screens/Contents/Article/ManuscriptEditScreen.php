<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Contents\Article;

use App\Models\User;
use App\Models\Article;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class ManuscriptEditScreen extends Screen
{
    /**
     * @var Article
     */
    public $article;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Article $article
     *
     * @return array
     */
    public function query(Article $article): array
    {
        $article->load('attachment');

        return [
            'article' => $article
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->article->exists ? 'Edit Article' : 'Creating a New Article';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Blog Article";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.articles',
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
                ->confirm(__('Once the article is deleted, all of its resources and data will be permanently deleted. Before deleting your article, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->article->exists),

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
                Relation::make('article.author')
                    ->title('Author')
                    ->required()
                    ->horizontal()
                    ->fromModel(User::class, 'name'),

                Relation::make('article.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentType::class, 'name')->applyScope('content'),

                Input::make('article.name')
                    ->title('Name')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this article.'),

                Cropper::make('article.image')
                    ->title('Image')
                    ->width(1000)
                    ->height(476)
                    ->keepAspectRatio()
                    ->horizontal(),

                TextArea::make('article.description')
                    ->title('Description')
                    ->horizontal()
                    ->required()
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Quill::make('article.body')
                    ->horizontal()
                    ->required()
                    ->title('Main text'),


                Group::make([
                    Switcher::make('article.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Highlight News'),

                    Switcher::make('article.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Status'),
                ]),
            ])

        ];
    }

    /**
     * @param Article    $article
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Article $article, Request $request)
    {
        $data = $request->get('article');
        $data['slug']   = Str::slug($data['name']);
        $data['image']  = url('public' . $data['image']);

        $article->fill($data)->save();

        Toast::info(__('Article was saved.'));

        return redirect()->route('platform.systems.articles');
    }

    /**
     * @param Article $article
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Article $article)
    {
        $article->delete();

        Toast::info(__('Article was removed'));

        return redirect()->route('platform.systems.articles');
    }
}
