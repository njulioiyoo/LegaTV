<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\MasterData\Partnership;

use Orchid\Screen\TD;
use App\Models\Partnership;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class PartnershipListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'partnership';

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
                ->render(function (Partnership $partnership) {
                    return Link::make($partnership->name)
                        ->route('platform.systems.partnerships.edit', $partnership);
                }),

            TD::make(__('Image'))
                ->render(function (Partnership $partnership) {
                    return '<img src="' . $partnership->image . '" width="100">';
                }),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (Partnership $partnership) => $partnership->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(fn (Partnership $partnership) => $partnership->updated_at),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Partnership $partnership) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.partnerships.edit', $partnership->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the partnership is deleted, all of its resources and data will be permanently deleted. Before deleting your partnership, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $partnership->id,
                            ]),
                    ])),
        ];
    }
}
