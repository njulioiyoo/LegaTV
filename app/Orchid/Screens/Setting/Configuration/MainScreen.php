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
        $promoAd250x250 = $configurations['promo_ad_250x250'] ?? '';
        $promoAd870x200 = $configurations['promo_ad_870x200'] ?? '';

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
                'Banner' =>
                Layout::rows([
                    Cropper::make('promo_ad_250x250')
                        ->title('Promo Ad (250x250)')
                        ->width(200)
                        ->height(200)
                        ->keepAspectRatio()
                        ->value($promoAd250x250)
                        ->horizontal(),
                    Cropper::make('promo_ad_870x200')
                        ->title('Promo Ad (870x200)')
                        ->width(870)
                        ->height(130)
                        ->keepAspectRatio()
                        ->value($promoAd870x200)
                        ->horizontal(),
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
            if ($value !== null) {
                $configuration->value = $value;
                $configuration->save();
            } else {
                $configuration->delete();
            }
        }

        Toast::info(__('Configuration was saved.'));

        return redirect()->route('platform.systems.configurations');
    }
}
