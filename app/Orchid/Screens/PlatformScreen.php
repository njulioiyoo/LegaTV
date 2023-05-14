<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Content;
use App\Models\News;
use Orchid\Screen\TD;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Fish text for the table.
     */
    public const TEXT_EXAMPLE = 'Lorem ipsum at sed ad fusce faucibus primis, potenti inceptos ad taciti nisi tristique
    urna etiam, primis ut lacus habitasse malesuada ut. Lectus aptent malesuada mattis ut etiam fusce nec sed viverra,
    semper mattis viverra malesuada quam metus vulputate torquent magna, lobortis nec nostra nibh sollicitudin
    erat in luctus.';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // Menghitung persentase perubahan pada model News
        $newsTotalViewedToday   = \App\Helpers\CommonHelper::getTotalViewedToday(Content::class, 'news');
        $newsPercentChange      = \App\Helpers\CommonHelper::getPercentChange(Content::class, 'news');

        // Menghitung persentase perubahan pada model Program
        $programTotalViewedToday   = \App\Helpers\CommonHelper::getTotalViewedToday(Content::class, 'program');
        $programPercentChange      = \App\Helpers\CommonHelper::getPercentChange(Content::class, 'program');

        $totalContent = Content::where([
            ['active', '=', 1],
            ['parent_id', '!=', null]
        ])->count();

        return [
            'news' => Content::where([
                ['active', '=', 1],
                ['parent_id', '!=', null]
            ])->orderBy('viewed', 'desc')->paginate(5),
            'metrics' => [
                'program'   => ['value' => $programTotalViewedToday, 'diff' => $programPercentChange],
                'news'      => ['value' => $newsTotalViewedToday, 'diff' => $newsPercentChange],
                'content'    => ['value' => number_format($totalContent)],
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Dashboard';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Welcome to your LegaTV CMS application.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Total Program Visitors Today'    => 'metrics.program',
                'Total News Visitors Today' => 'metrics.news',
                'Total Contents & VOD' => 'metrics.content',
            ]),
            Layout::table('news', [
                TD::make('image', 'Image')
                    ->width('150')
                    ->render(fn (Content $model) => // Please use view('path')
                    "<img src='{$model->image}'
                              alt='sample'
                              class='mw-100 d-block img-fluid rounded-1 w-100'>
                            <span class='small text-muted mt-1 mb-0'># {$model->type}</span>"),
                TD::make('body', 'Body')
                    ->width('450')
                    ->render(fn (Content $model) => Str::limit($model->body, 200)),
                TD::make('viewed', 'Viewed')
                    ->render(fn (Content $model) => $model->viewed),
                TD::make('author', __('Author'))
                    ->sort()
                    ->render(fn (Content $article) => $article->user->name),
                TD::make('created_at', __('Created'))
                    ->sort()
                    ->render(fn (Content $news) => $news->created_at),
            ]),
        ];
    }
}
