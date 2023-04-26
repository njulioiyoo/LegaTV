<?php

namespace App\Orchid\Screens\Setting\Configuration;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;

class MainScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Site Configurations';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Components for laying out your project';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.configurations',
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
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @throws \Throwable
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        $configurations = Configuration::pluck('value', 'key')->all();
        $websiteLogo = $configurations['website_logo'] ?? '';

        return [
            Layout::tabs([
                'General' =>
                Layout::rows([
                    Input::make('website_name')
                        ->horizontal()
                        ->title('Website Name')
                        ->placeholder('Enter website name')
                        ->value($configurations['website_name'] ?? ''),
                    TextArea::make('website_description')
                        ->horizontal()
                        ->title('Website Description')
                        ->placeholder('Enter website description')
                        ->value($configurations['website_description'] ?? ''),
                    TextArea::make('website_contact_info')
                        ->horizontal()
                        ->title('Website Contact Information')
                        ->placeholder('Enter website contact information')
                        ->rows(5)
                        ->value($configurations['website_contact_info'] ?? ''),
                    Input::make('website_mail')
                        ->horizontal()
                        ->title('Website Email')
                        ->placeholder('Enter website email')
                        ->type('email')
                        ->value($configurations['website_mail'] ?? ''),
                    Cropper::make('website_logo')
                        ->title('Website Logo')
                        ->width(400)
                        ->height(145)
                        ->keepAspectRatio()
                        ->value($websiteLogo)
                        ->horizontal(),
                    Switcher::make('status_live_news')
                        ->sendTrueOrFalse()
                        ->title('Status Live News')
                        ->value($configurations['status_live_news'] ?? '')
                        ->horizontal()
                ]),
                'Social Media' => Layout::rows([
                    Input::make('facebook')
                        ->horizontal()
                        ->title('Facebook')
                        ->placeholder('Enter facebook url')
                        ->type('url')
                        ->value($configurations['facebook'] ?? ''),
                    Input::make('twitter')
                        ->horizontal()
                        ->title('Twitter')
                        ->placeholder('Enter twitter url')
                        ->type('url')
                        ->value($configurations['facebook'] ?? ''),
                    Input::make('instagram')
                        ->horizontal()
                        ->title('Instagram')
                        ->placeholder('Enter instagram url')
                        ->type('url')
                        ->value($configurations['instagram'] ?? ''),
                ]),
                'Policies' =>
                Layout::rows([
                    Quill::make('terms_conditions')
                        ->horizontal()
                        ->value($configurations['terms_conditions'] ?? '')
                        ->title('Terms and Conditions'),
                    Quill::make('privacy_policy')
                        ->horizontal()
                        ->value($configurations['privacy_policy'] ?? '')
                        ->title('Privacy Policy'),
                ]),
                'Live TV' =>
                Layout::rows([
                    Input::make('live_tv')
                        ->horizontal()
                        ->title('Live TV')
                        ->placeholder('Enter url live tv')
                        ->type('url')
                        ->value($configurations['live_tv'] ?? ''),

                    Switcher::make('status_live_tv')
                        ->sendTrueOrFalse()
                        ->title('Status Live TV')
                        ->value($configurations['status_live_tv'] ?? '')
                        ->horizontal()
                ]),
            ]),
        ];
    }

    /**
     * @param Configuration    $configuration
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $configurations = $request->except('_token');

        foreach ($configurations as $key => $value) {
            $configuration = Configuration::where('key', $key)->first();
            if (!$configuration) {
                $configuration = new Configuration();
                $configuration->key = $key;
            }
            if ($configuration->value !== $value) {
                $configuration->value = $value;
                $configuration->save();
            }
        }

        Toast::info(__('Configuration was saved.'));

        return redirect()->route('platform.systems.configurations');
    }
}
