@extends('templates.layout')

@section('content')

<!-- BANNER WRAP -->
<div class="banner-wrap geeky-news">
    <!-- BANNER -->
    <div class=" banner grid-limit">
        <h2 class="banner-title">News</h2>
        <p class="banner-sections">
            <span class="banner-section">Home</span>
            <!-- ARROW ICON -->
            <svg class="arrow-icon">
                <use xlink:href="#svg-arrow"></use>
            </svg>
            <!-- /ARROW ICON -->
            <span class="banner-section">News</span>
        </p>
    </div>
    <!-- /BANNER -->
</div>
<!-- /BANNER WRAP -->

@include('templates.elements.live-news')

<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 grid-limit">
    <!-- LAYOUT BODY -->
    @if(count($news) > 0)
    <div class="layout-body">
        <!-- LAYOUT ITEM -->
        <div class="layout-item grid-2col_3 centered gutter-mid">
            <!-- POST PREVIEW -->
            @foreach($news as $k => $n)
            <div class="post-preview medium movie-news">
                <!-- POST PREVIEW IMG WRAP -->
                <a href="{{ route('news.detail', $n['slug']) }}">
                    <div class="post-preview-img-wrap">
                        <!-- POST PREVIEW IMG -->
                        <figure class="post-preview-img liquid">
                            <img src="{{ $n['image'] }}" alt="post-03">
                        </figure>
                        <!-- POST PREVIEW IMG -->
                    </div>
                </a>
                <!-- /POST PREVIEW IMG WRAP -->

                <!-- TAG ORNAMENT -->
                <a href="#" class="tag-ornament">{{ $n['parent']->name }}</a>
                <!-- /TAG ORNAMENT -->

                <!-- POST PREVIEW TITLE -->
                <a href="{{ route('news.detail', $n['slug']) }}" class="post-preview-title">{{ $n['name'] }}</a>
                <!-- POST AUTHOR INFO -->
                <div class="post-author-info-wrap">
                    <!-- USER AVATAR -->
                    <a href="#">
                        <figure class="user-avatar tiny liquid">
                            <img src="{{ asset('assets/img/users/03.jpg') }}" alt="user-03">
                        </figure>
                    </a>
                    <!-- /USER AVATAR -->
                    <p class="post-author-info small light">By <a href="#" class="post-author">{{ $n['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($n['created_at'])) }}</p>
                </div>
                <!-- /POST AUTHOR INFO -->
                <!-- POST PREVIEW TEXT -->
                <p class="post-preview-text">{{ Str::limit($n['body'], 100) }}</p>
            </div>
            @endforeach
            <!-- /POST PREVIEW -->
        </div>
        <!-- /LAYOUT ITEM -->

        <!-- PAGE NAVIGATION -->
        <div class="page-navigation green center spaced">
            <!-- CONTROL PREVIOUS -->
            <div class="slider-control big control-previous">
                <!-- ARROW ICON -->
                <svg class="arrow-icon medium">
                    <use xlink:href="#svg-arrow-medium"></use>
                </svg>
                <!-- /ARROW ICON -->
            </div>
            <!-- /CONTROL PREVIOUS -->
            @for ($i = 1; $i <= $news->lastPage(); $i++)
                <a href="{{ $news->url($i) }}" class="page-navigation-item{{ $news->currentPage() === $i ? ' active' : '' }}">{{ $i }}</a>
                @endfor
                <!-- CONTROL PREVIOUS -->
                <div class="slider-control big control-next">
                    <!-- ARROW ICON -->
                    <svg class="arrow-icon medium">
                        <use xlink:href="#svg-arrow-medium"></use>
                    </svg>
                    <!-- /ARROW ICON -->
                </div>
                <!-- /CONTROL PREVIOUS -->
        </div>

        <!-- PAGINATION SCRIPT -->
        @push('scripts')
        <script>
            var paginationLinks = document.querySelectorAll('.page-navigation-item');
            for (var i = 0; i < paginationLinks.length; i++) {
                paginationLinks[i].addEventListener('click', function(event) {
                    event.preventDefault();
                    var url = this.getAttribute('href');
                });
            }
        </script>
        @endpush


    </div>
    <!-- /LAYOUT BODY -->
    <!-- LAYOUT SIDEBAR -->
    <div class="layout-sidebar layout-item gutter-medium">
        <!-- WIDGET SIDEBAR -->
        <div class="widget-sidebar">
            <!-- SECTION TITLE WRAP -->
            <div class="section-title-wrap blue">
                <h2 class="section-title medium">Popular Posts</h2>
                <div class="section-title-separator"></div>
            </div>
            <!-- /SECTION TITLE WRAP -->

            <!-- POST PREVIEW SHOWCASE -->
            <div class="post-preview-showcase grid-1col centered gutter-small">
                <!-- POST PREVIEW -->
                @foreach($popularNews as $k => $p)
                <div class="post-preview tiny gaming-news">
                    <!-- POST PREVIEW IMG WRAP -->
                    <a href="{{ route('news.detail', $p['slug']) }}">
                        <div class="post-preview-img-wrap">
                            <!-- POST PREVIEW IMG -->
                            <figure class="post-preview-img liquid">
                                <img src="{{ $p['image'] }}" alt="post-01">
                            </figure>
                            <!-- /POST PREVIEW IMG -->
                        </div>
                    </a>
                    <!-- /POST PREVIEW IMG WRAP -->

                    <!-- POST PREVIEW TITLE -->
                    <a href="{{ route('news.detail', $p['slug']) }}" class="post-preview-title">{{ Str::limit($p['name'], 65) }}</a>
                    <!-- POST AUTHOR INFO -->
                    <div class="post-author-info-wrap">
                        <p class="post-author-info small light">By <a href="#" class="post-author">{{ $p['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($p['created_at'])) }}</p>
                    </div>
                    <!-- /POST AUTHOR INFO -->
                </div>
                @endforeach
                <!-- /POST PREVIEW -->
            </div>
            <!-- /POST PREVIEW SHOWCASE -->
        </div>
        <!-- /WIDGET SIDEBAR -->

        <!-- WIDGET SIDEBAR -->
        <div class="widget-sidebar">
            <!-- PROMO ADVERT -->
            <div class="promo-advert">
                <a href="#">
                    <!-- PROMO ADVERT IMG -->
                    <img class="promo-advert-img" src="{{ asset('assets/img/banners/promo-ad-1.jpg') }}" alt="promo-ad-1">
                    <!-- /PROMO ADVERT IMG -->
                </a>
            </div>
            <!-- /PROMO ADVERT -->
        </div>
        <!-- /WIDGET SIDEBAR -->

        <!-- WIDGET SIDEBAR -->
        <div class="widget-sidebar">
            <!-- SECTION TITLE WRAP -->
            <div class="section-title-wrap red">
                <h2 class="section-title medium">Instagram Widget</h2>
                <div class="section-title-separator"></div>
            </div>
            <!-- /SECTION TITLE WRAP -->

            <!-- PHOTO LIST -->
            <div class="photo-list"></div>
            <!-- /PHOTO LIST -->
        </div>
        <!-- /WIDGET SIDEBAR -->
    </div>
    <!-- /LAYOUT SIDEBAR -->
    @endif
</div>
<!-- /LAYOUT CONTENT 1 -->

@endsection