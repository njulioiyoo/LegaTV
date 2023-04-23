<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\MasterData\ContentType;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;

class ContentTypeEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('contentType.type')
                ->options([
                    'contents'  => 'Contents',
                    'vod'       => 'Video On Demand',
                ])
                ->title('Select type')
                ->help('Allow search bots to index'),
            Input::make('contentType.name')
                ->type('text')
                ->max(50)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name'))
        ];
    }
}
