<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [

            Menu::make('')->title(__('Contents')),

            Menu::make(__('News'))
                ->icon('book-open')
                ->route('platform.systems.news')
                ->permission('platform.systems.news'),

            Menu::make(__('Articles'))
                ->icon('briefcase'),

            Menu::make(__('Local News'))
                ->icon('list')
                ->divider(),

            Menu::make('')->title(__('Video On Demands')),

            Menu::make(__('Programs'))
                ->icon('layers')
                ->route('platform.systems.program')
                ->permission('platform.systems.program'),

            Menu::make(__('Shorts'))
                ->icon('bar-chart')
                ->divider(),

            Menu::make('')->title(__('Master Data')),
            Menu::make(__('Partnerships'))
                ->icon('diamond')
                ->route('platform.systems.partnerships')
                ->permission('platform.systems.partnerships'),

            Menu::make(__('Content Type'))
                ->icon('new-doc')
                ->route('platform.systems.content_type')
                ->permission('platform.systems.content_type')->divider(),

            Menu::make('')->title(__('Settings')),

            Menu::make(__('Configurations'))
                ->icon('settings')
                ->route('platform.systems.configurations')
                ->permission('platform.systems.configurations')->divider(),

            Menu::make('')->title(__('Access Rights')),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users'),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.news', __('News'))
                ->addPermission('platform.systems.program', __('Programs'))
                ->addPermission('platform.systems.content_type', __('Content Type'))
                ->addPermission('platform.systems.partnerships', __('Partnerships'))
                ->addPermission('platform.systems.configurations', __('Configurations')),
        ];
    }
}
