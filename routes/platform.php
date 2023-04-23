<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;

use App\Orchid\Screens\Configuration\MainScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\News\ListScreen;
use App\Orchid\Screens\News\EditScreen;

use App\Orchid\Screens\Program\ProgramScreen;

use App\Orchid\Screens\MasterData\ContentType\ContentTypeScreen;
use App\Orchid\Screens\MasterData\Partnership\PartnershipEditScreen;
use App\Orchid\Screens\MasterData\Partnership\PartnershipListScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example screen'));

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', Idea::class, 'platform.screens.idea');

// Platform > System > Master Data > Content Type
Route::screen('content-type', ContentTypeScreen::class)
    ->name('platform.systems.content_type')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Content Type');
    });

// Platform > System > Master Data > Partnership
Route::screen('partnership', PartnershipListScreen::class)
    ->name('platform.systems.partnerships')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Partnership'), route('platform.systems.partnerships')));

// Platform > System > Master Data > Partnership > Create
Route::screen('partnership/create', PartnershipEditScreen::class)
    ->name('platform.systems.partnerships.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.partnerships')
        ->push(__('Create'), route('platform.systems.partnerships.create')));

// Platform > System >Master Data > Partnership > Edit
Route::screen('partnership/{partnership}/edit', PartnershipEditScreen::class)
    ->name('platform.systems.partnerships.edit')
    ->breadcrumbs(fn (Trail $trail, $partnership) => $trail
        ->parent('platform.systems.partnerships')
        ->push($partnership->name, route('platform.systems.partnerships.edit', $partnership)));

// Platform > System > Program
Route::screen('program', ProgramScreen::class)
    ->name('platform.systems.program')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Program');
    });

// Platform > System > News
Route::screen('news', ListScreen::class)
    ->name('platform.systems.news')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('News'), route('platform.systems.news')));

// Platform > System > News > Create
Route::screen('news/create', EditScreen::class)
    ->name('platform.systems.news.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.news')
        ->push(__('Create'), route('platform.systems.news.create')));

// Platform > System > News > News
Route::screen('news/{news}/edit', EditScreen::class)
    ->name('platform.systems.news.edit')
    ->breadcrumbs(fn (Trail $trail, $news) => $trail
        ->parent('platform.systems.news')
        ->push($news->name, route('platform.systems.news.edit', $news)));

// Platform > System > Configurations
Route::screen('configurations', MainScreen::class)
    ->name('platform.systems.configurations')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Configurations');
    });
