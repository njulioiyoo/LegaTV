<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Contents\Article;

use Orchid\Screen\TD;
use App\Models\Article;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class ManuscriptListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'article';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Article $article) {
                    return Link::make($article->name)
                        ->route('platform.systems.articles.edit', $article);
                }),

            TD::make(__('Image'))
                ->render(function (Article $article) {
                    return '<img src="' . $article->image . '" width="100">';
                }),

            TD::make('is_highlight', __('Highlight Article'))
                ->sort()
                ->render(fn (Article $article) => $article->is_highlight ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('viewed', __('Total Viewed'))
                ->sort()
                ->render(fn (Article $article) => $article->viewed),

            TD::make('parent_id', __('Categories'))
                ->sort()
                ->render(fn (Article $article) => $article->parent->name),

            TD::make('author', __('Author'))
                ->sort()
                ->render(fn (Article $article) => $article->user->name),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(fn (Article $article) => $article->updated_at),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (Article $article) => $article->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Article $article) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        // Link::make(__('Edit'))
                        //     ->route('platform.systems.article.edit', $article->id)
                        //     ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the article is deleted, all of its resources and data will be permanently deleted. Before deleting your article, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $article->id,
                            ]),
                    ])),
        ];
    }
}
