@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp
<!-- SEARCH POPUP -->
<div class="search-popup">
    <!-- CROSS ICON -->
    <svg class="cross-icon big close-button search-popup-close">
        <use xlink:href="#svg-cross-big"></use>
    </svg>
    <!-- /CROSS ICON -->
    <form action="{{ route('search') }}" method="GET" autocomplete="off" class="search-popup-form">
        <input name="key" type="text" minlength="3" class="input-line" placeholder="What are you looking for...?">
    </form>
    <p class="search-popup-text">Write what you are looking for and press enter to begin your search!</p>
</div>
<!-- /SEARCH POPUP -->

<!-- MOBILE MENU WRAP -->
<div class="mobile-menu-wrap">
    <!-- CROSS ICON -->
    <svg class="cross-icon big mobile-menu-close">
        <use xlink:href="#svg-cross-big"></use>
    </svg>
    <!-- /CROSS ICON -->

    <!-- SEARCH POPUP OPEN -->
    <svg class="search-popup-open search-icon">
        <use xlink:href="#svg-search"></use>
    </svg>
    <!-- /SEARCH POPUP OPEN -->

    <!-- LOGO IMG -->
    <figure class="logo-img">
        <img src="{{ $configurations['website_logo'] ? asset($configurations['website_logo']) : 'https://via.placeholder.com/1000x476.png?text=No+Image' }}" alt="Logo">
    </figure>
    <!-- /LOGO IMG -->

    <!-- MOBILE MENU -->
    <ul class="mobile-menu">
        <!-- MOBILE MENU ITEM -->
        @foreach (App\Helpers\MenuHelper::getMenu() as $menu)
        <li class="mobile-menu-item">
            <a href="{{ $menu['url'] }}" class="mobile-menu-item-link">{{ $menu['name'] }}</a>
        </li>
        @endforeach
        <!-- /MOBILE MENU ITEM -->
    </ul>
    <!-- /MOBILE MENU -->
</div>
<!-- /MOBILE MENU WRAP -->

<!-- NAVIGATION WRAP -->
<nav class="navigation-wrap">
    <!-- NAVIGATION -->
    <div class="navigation grid-limit">
        <!-- LOGO -->
        <div class="logo">
            <!-- LOGO IMG -->
            <figure class="logo-img">
                <img src="{{ $configurations['website_logo'] ? asset($configurations['website_logo']) : 'https://via.placeholder.com/1000x476.png?text=No+Image' }}" alt="Logo">
            </figure>
            <!-- /LOGO IMG -->
        </div>
        <!-- /LOGO -->

        <!-- SEARCH BUTTON -->
        <div class="search-button search-popup-open">
            <!-- SEARCH ICON -->
            <svg class="search-icon">
                <use xlink:href="#svg-search"></use>
            </svg>
            <!-- /SEARCH ICON -->
        </div>
        <!-- /SEARCH BUTTON -->

        <!-- MAIN MENU -->
        <ul class="main-menu">
            <!-- MAIN MENU ITEM -->
            @foreach (App\Helpers\MenuHelper::getMenu() as $menu)
            <li class="main-menu-item">
                <a href="{{ $menu['url'] }}" class="main-menu-item-link">{{ $menu['name'] }}</a>
            </li>
            @endforeach
            <!-- /MAIN MENU ITEM -->
        </ul>
        <!-- /MAIN MENU -->
    </div>
    <!-- NAVIGATION -->
</nav>
<!-- /NAVIGATION WRAP -->

<!-- MOBILE MENU PULL -->
<div class="mobile-menu-pull mobile-menu-open">
    <!-- MENU PULL ICON -->
    <svg class="menu-pull-icon">
        <use xlink:href="#svg-menu-pull"></use>
    </svg>
    <!-- /MENU PULL ICON -->
</div>
<!-- /MOBILE MENU PULL -->