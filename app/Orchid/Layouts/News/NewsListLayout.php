<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\News;

use App\Models\News;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class NewsListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'news';

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
                ->render(function (News $news) {
                    return Link::make($news->name)
                        ->route('platform.systems.news.edit', $news);
                }),

            TD::make('viewed', __('Total Viewed'))
                ->sort()
                ->render(fn (News $news) => $news->viewed),

            TD::make('parent_id', __('Categories'))
                ->sort()
                ->render(fn (News $news) => $news->parent->name),

            TD::make('author', __('Author'))
                ->sort()
                ->render(fn (News $news) => $news->user->name),

            TD::make('is_shared_to_live', __('Share to Live News'))
                ->sort()
                ->render(fn (News $news) => $news->is_shared_to_live ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(fn (News $news) => $news->updated_at),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (News $news) => $news->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (News $news) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.news.edit', $news->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the news is deleted, all of its resources and data will be permanently deleted. Before deleting your news, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $news->id,
                            ]),
                    ])),
        ];
    }
}
