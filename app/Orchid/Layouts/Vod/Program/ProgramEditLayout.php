<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Vod\Program;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use App\Models\ContentType;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class ProgramEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Relation::make('program.author')
                ->title('Author')
                ->required()
                ->fromModel(User::class, 'name'),

            Relation::make('program.parent_id')
                ->title('Content Categories')
                ->required()
                ->fromModel(ContentType::class, 'name')->applyScope('vod'),

            Input::make('program.source')
                ->title('Youtube URL')
                ->placeholder('Share Youtube URL video on your program')
                ->help('Specify a short descriptive title for this program.'),

            Group::make([
                Switcher::make('program.is_featured')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_RIGHT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Featured Program'),

                Switcher::make('program.is_shared_to_live')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_LEFT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Share to Live TV'),
            ]),
            Group::make([
                Switcher::make('program.active')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_RIGHT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Status'),
            ]),
        ];
    }
}
