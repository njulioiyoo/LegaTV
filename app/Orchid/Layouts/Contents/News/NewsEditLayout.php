<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Contents\News;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use App\Models\ContentType;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class NewsEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
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

                Switcher::make('news.is_shared_to_live')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_RIGHT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Shared to Live News'),

                Switcher::make('news.active')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_RIGHT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Status'),
            ]),
        ];
    }
}
