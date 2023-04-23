<?php

declare(strict_types=1);

namespace App\Orchid\Screens\MasterData\Partnership;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;

class PartnershipEditScreen extends Screen
{
    /**
     * @var Partnership
     */
    public $partnership;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Partnership $partnership
     *
     * @return array
     */
    public function query(Partnership $partnership): array
    {
        $partnership->load('attachment');

        return [
            'partnership' => $partnership
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->partnership->exists ? 'Edit Partnership' : 'Creating a New Partnership';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Blog Partnership";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.partnerships',
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
                ->confirm(__('Once the partnership is deleted, all of its resources and data will be permanently deleted. Before deleting your partnership, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->partnership->exists),

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
                Input::make('partnership.name')
                    ->title('Name')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this partnership.'),

                Cropper::make('partnership.image')
                    ->title('Image')
                    ->required()
                    ->width(1000)
                    ->height(476)
                    ->keepAspectRatio()
                    ->horizontal(),

                Switcher::make('partnership.active')
                    ->sendTrueOrFalse()
                    ->title('Status')
                    ->horizontal(),
            ])

        ];
    }

    /**
     * @param Partnership    $partnership
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Partnership $partnership, Request $request)
    {
        $data = $request->get('partnership');
        $data['slug']   = Str::slug($data['name']);
        $data['image']  = url('public' . $data['image']);

        $partnership->fill($data)->save();

        Toast::info(__('Partnership was saved.'));

        return redirect()->route('platform.systems.partnerships');
    }

    /**
     * @param Partnership $partnership
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Partnership $partnership)
    {
        $partnership->delete();

        Toast::info(__('Partnership was removed'));

        return redirect()->route('platform.systems.partnerships');
    }
}
