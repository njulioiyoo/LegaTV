<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\ContentCategories;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class EditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('contentCategories.type')
                ->options([
                    'contents'  => 'Contents',
                    'vod'       => 'Video On Demand',
                ])
                ->title('Select type')
                ->help('Allow search bots to index'),
            Input::make('contentCategories.name')
                ->type('text')
                ->max(50)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name'))
        ];
    }
}
