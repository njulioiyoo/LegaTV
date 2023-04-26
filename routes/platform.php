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

use App\Orchid\Screens\Setting\Configuration\MainScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;

use App\Orchid\Screens\Contents\Article\ManuscriptListScreen;
use App\Orchid\Screens\Contents\Article\ManuscriptEditScreen;

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\Contents\News\NewsScreen;
use App\Orchid\Screens\Vod\Program\ProgramScreen;

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

// Platform > System > Master Data > Partnership > Edit
Route::screen('partnership/{partnership}/edit', PartnershipEditScreen::class)
    ->name('platform.systems.partnerships.edit')
    ->breadcrumbs(fn (Trail $trail, $partnership) => $trail
        ->parent('platform.systems.partnerships')
        ->push($partnership->name, route('platform.systems.partnerships.edit', $partnership)));

// Platform > System > Video On Demands > Program
Route::screen('program', ProgramScreen::class)
    ->name('platform.systems.program')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Program');
    });

// Platform > System > Contents > News
Route::screen('news', NewsScreen::class)
    ->name('platform.systems.news')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('News');
    });

// Platform > System > Contents > Articles
Route::screen('article', ManuscriptListScreen::class)
    ->name('platform.systems.articles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Article'), route('platform.systems.articles')));

// Platform > System > Contents > Articles > Create
Route::screen('article/create', ManuscriptEditScreen::class)
    ->name('platform.systems.articles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.articles')
        ->push(__('Create'), route('platform.systems.articles.create')));

// Platform > System > Contents > Articles > Edit
Route::screen('article/{article}/edit', ManuscriptEditScreen::class)
    ->name('platform.systems.articles.edit')
    ->breadcrumbs(fn (Trail $trail, $article) => $trail
        ->parent('platform.systems.articles')
        ->push($article->name, route('platform.systems.articles.edit', $article)));

// Platform > System > Settings > Configurations
Route::screen('configurations', MainScreen::class)
    ->name('platform.systems.configurations')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Configurations');
    });
