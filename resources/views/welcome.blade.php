@extends('templates.layout')

@section('meta-name')
<meta name="title" content="Berita Terkini dan Informasi Terbaru Hari Ini">
<meta name="description" content="Lega TV - Situs portal berita nasional dan daerah yang menyajikan informasi terkini dan terbaru seperti, Berita Politik, Hukum, Keuangan, Teknologi">
<meta name="keywords" content="legatv, legatvonline, berita terkini, berita hari ini, berita terbaru, kabar terkini, kabar terbaru, seputar indonesia, berita daerah, berita indonesia">
@endsection

@section('title', 'Home')

@section('content')
<!-- BANNER SLIDER -->
@if(count($content) > 0)
<div id="banner-slider-2" class="banner-slider v2">
    <!-- SLIDER ITEMS -->
    <div class="slider-items">
        <!-- SLIDER ITEM -->
        @foreach($content as $k => $v)
        <div class="slider-item slider-item-{{ $k+1 }}" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url('{{ $v['image'] }}') no-repeat center; background-size: cover;">
            <div class="slider-item-wrap">
                <!-- POST PREVIEW -->
                <div class="post-preview huge centered gaming-news">
                    <!-- TAG ORNAMENT -->
                    <!-- /TAG ORNAMENT -->
                    <!-- POST PREVIEW TITLE -->
                    <a href="{{ route(''.$v['type'].'.detail', $v['slug']) }}" class="post-preview-title" style="font-size: 1.125em;">{{ $v['name'] }}</a>
                    <!-- POST AUTHOR INFO -->
                    <div class="post-author-info-wrap">
                        <!-- USER AVATAR -->
                        <a href="search-results.html">
                            <figure class="user-avatar tiny liquid">
                                <img src="{{ asset('assets/img/users/03.jpg') }}" alt="user-01">
                            </figure>
                        </a>
                        <!-- /USER AVATAR -->
                        <p class="post-author-info small light">By <a href="#" class="post-author">{{ $v['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($v['created_at'])) }}</p>
                    </div>
                    <!-- /POST AUTHOR INFO -->
                    <div class="break"></div>
                    <!-- BUTTON -->
                    <a href="{{ route(''.$v['type'].'.detail', $v['slug']) }}" class="button blue">
                        Go to the content
                        <!-- BUTTON ORNAMENT -->
                        <div class="button-ornament">
                            <!-- ARROW ICON -->
                            <svg class="arrow-icon medium">
                                <use xlink:href="#svg-arrow-medium"></use>
                            </svg>
                            <!-- /ARROW ICON -->

                            <!-- CROSS ICON -->
                            <svg class="cross-icon small">
                                <use xlink:href="#svg-cross-small"></use>
                            </svg>
                            <!-- /CROSS ICON -->
                        </div>
                        <!-- /BUTTON ORNAMENT -->
                    </a>
                    <!-- /BUTTON -->
                </div>
                <!-- /POST PREVIEW -->
            </div>
        </div>
        @endforeach
        <!-- /SLIDER ITEM -->
    </div>
    <!-- /SLIDER ITEMS -->

    <!-- BANNER SLIDER PREVIEW WRAP -->
    <div class="banner-slider-preview-wrap">
        <!-- BANNER SLIDER CONTROLS -->
        <div id="sliderb2-controls" class="banner-slider-controls">
            <div class="control-previous">
                <!-- ARROW ICON -->
                <svg class="arrow-icon medium">
                    <use xlink:href="#svg-arrow-medium"></use>
                </svg>
                <!-- /ARROW ICON -->
            </div>
            <div class="control-next">
                <!-- ARROW ICON -->
                <svg class="arrow-icon medium">
                    <use xlink:href="#svg-arrow-medium"></use>
                </svg>
                <!-- /ARROW ICON -->
            </div>
        </div>
        <!-- /BANNER SLIDER CONTROLS -->

        <!-- BANNER SLIDER PREVIEW -->
        <div id="banner-slider-2-thumbs" class="banner-slider-preview">
            <!-- BANNER SLIDER PREVIEW ROSTER -->
            <div class="banner-slider-preview-roster">
                <!-- POST PREVIEW -->
                @foreach($content as $k => $v)
                <div class="post-preview tiny negative no-img gaming-news">
                    <!-- POST PREVIEW TITLE -->
                    <p class="post-preview-title">{{ $v['name'] }}</p>
                    <!-- POST AUTHOR INFO -->
                    <div class="post-author-info-wrap">
                        <p class="post-author-info small light">By <a href="#" class="post-author">{{ $v['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($v['created_at'])) }}</p>
                    </div>
                    <!-- /POST AUTHOR INFO -->
                </div>
                @endforeach
                <!-- /POST PREVIEW -->
            </div>
            <!-- /BANNER SLIDER PREVIEW ROSTER -->
        </div>
        <!-- /BANNER SLIDER ROSTER -->
    </div>
    <!-- /BANNER SLIDER PREVIEW WRAP -->
</div>
@endif
<!-- /BANNER SLIDER -->

@include('templates.elements.live-news')

@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp
<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 search-pad grid-limit">
    <!-- LAYOUT BODY -->
    <div class="layout-body layout-item centered">
        <!-- LAYOUT ITEM -->
        <div class="layout-item centered">
            <!-- POSTSLIDE WRAP -->
            <div class="postslide-wrap">
                <!-- POSTSLIDE -->
                <div id="postslide-1" class="postslide">
                    <!-- NEWS PREVIEW -->
                    <div class="news-preview slider-items">
                        <!-- POST PREVIEW -->
                        @foreach (App\Helpers\CommonHelper::getLatestProgram(null) as $latestProgram)
                        <div class="post-preview picture big gaming-news">
                            <!-- POST PREVIEW IMG WRAP -->
                            <a href="{{ route('program.detail', $latestProgram['slug']) }}">
                                <div class="post-preview-img-wrap">
                                    <!-- POST PREVIEW IMG -->
                                    <figure class="post-preview-img liquid">
                                        <img src="{{ $latestProgram['image'] }}" alt="post-07">
                                    </figure>
                                    <!-- /POST PREVIEW IMG -->

                                    <!-- POST PREVIEW OVERLAY -->
                                    <div class="post-preview-overlay">

                                        <!-- POST PREVIEW TITLE -->
                                        <p class="post-preview-title">{{ $latestProgram['name'] }}</p>
                                        <!-- POST PREVIEW TEXT -->
                                        <p class="post-preview-text">{{ Str::limit($latestProgram['body'], 100) }}</p>
                                    </div>
                                    <!-- /POST PREVIEW OVERLAY -->

                                    <!-- LOADING LINE -->
                                    <div class="loading-line"></div>
                                    <!-- /LOADING LINE -->
                                </div>
                            </a>
                            <!-- /POST PREVIEW IMG WRAP -->
                        </div>
                        @endforeach
                        <!-- /POST PREVIEW -->
                    </div>
                    <!-- /NEWS PREVIEW -->

                    <!-- NEWS ROSTER -->
                    <div class="news-roster slider-roster">
                        <!-- POST PREVIEW -->
                        @foreach (App\Helpers\CommonHelper::getLatestProgram(null) as $latestProgram)
                        <div class="post-preview picture short gaming-news">
                            <!-- POST PREVIEW IMG WRAP -->
                            <div class="post-preview-img-wrap">
                                <!-- POST PREVIEW IMG -->
                                <figure class="post-preview-img liquid">
                                    <img src="{{ $latestProgram['image'] }}" alt="post-07">
                                </figure>
                                <!-- /POST PREVIEW IMG -->

                                <!-- POST PREVIEW OVERLAY -->
                                <div class="post-preview-overlay">
                                    <!-- POST PREVIEW TITLE -->
                                    <p class="post-preview-title">{{ $latestProgram['name'] }}</p>
                                </div>
                                <!-- /POST PREVIEW OVERLAY -->
                            </div>
                            <!-- /POST PREVIEW IMG WRAP -->

                            <!-- LOADING LINE -->
                            <div class="loading-line"></div>
                            <!-- /LOADING LINE -->

                            <!-- OVERLAY -->
                            <div class="overlay"></div>
                            <!-- /OVERLAY -->
                        </div>
                        @endforeach
                        <!-- /POST PREVIEW -->
                    </div>
                    <!-- /NEWS ROSTER -->
                </div>
                <!-- POSTSLIDE -->

                <!-- SLIDER CONTROLS -->
                <div id="postslide-1-controls" class="slider-controls blue">
                    <!-- CONTROL PREVIOUS -->
                    <div class="slider-control big control-previous">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                    <!-- /CONTROL PREVIOUS -->

                    <!-- CONTROL NEXT -->
                    <div class="slider-control big control-next">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                    <!-- /CONTROL NEXT -->
                </div>
                <!-- /SLIDER CONTROLS -->
            </div>
            <!-- /POSTSLIDE WRAP -->
        </div>
        <!-- /LAYOUT ITEM -->

        <!-- LAYOUT ITEM -->
        @if(count($news) > 0)
        <div class="layout-item">
            <!-- POST PREVIEW -->
            @foreach($news as $k => $n)
            <div class="post-preview landscape big gaming-news">
                <!-- POST PREVIEW IMG WRAP -->
                <a href="{{ route('news.detail', $n['slug']) }}">
                    <div class="post-preview-img-wrap">
                        <!-- POST PREVIEW IMG -->
                        <figure class="post-preview-img liquid">
                            <img src="{{ $n['image'] }}" alt="post-01">
                        </figure>
                        <!-- POST PREVIEW IMG -->
                    </div>
                </a>
                <!-- /POST PREVIEW IMG WRAP -->

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
                <p class="post-preview-text">{!! Str::limit($n['body'], 200) !!}</p>
            </div>
            @endforeach
            <!-- /POST PREVIEW -->
        </div>
        @endif
        <!-- /LAYOUT ITEM -->

        <!-- LAYOUT ITEM -->
        @if(!empty($configurations['promo_ad_870x200']))
        <div class="layout-item padded">
            <a href="#">
                <!-- PROMO BANNER -->
                <img src="{{ asset($configurations['promo_ad_870x200']) }}" alt="promo-banner-img" class="promo-banner-img">
                <!-- /PROMO BANNER -->
            </a>
        </div>
        @endif
        <!-- /LAYOUT ITEM -->

        <!-- LAYOUT ITEM -->
        <div class="layout-item padded own-grid">
            <!-- SECTION TITLE WRAP -->
            <div class="section-title-wrap yellow">
                <h2 class="section-title medium">{{ $mostUsedCategory['parent']->name }} Program</h2>
                <div class="section-title-separator"></div>

                <!-- SLIDER CONTROLS -->
                <div id="gknews-slider1-controls" class="carousel-controls slider-controls yellow">
                    <div class="slider-control control-previous">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                    <div class="slider-control control-next">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                </div>
                <!-- /SLIDER CONTROLS -->
            </div>
            <!-- /SECTION TITLE WRAP -->

            <!-- CAROUSEL -->
            <div id="gknews-slider1" class="carousel">
                <!-- CAROUSEL ITEMS -->
                <div class="carousel-items">
                    <!-- POST PREVIEW -->
                    @foreach($program as $k => $p)
                    <div class="post-preview video gaming-news no-hover">
                        <!-- POST PREVIEW IMG WRAP -->
                        <a href="{{ route('program.detail', $p['slug']) }}">
                            <div class="post-preview-img-wrap">
                                <!-- POST PREVIEW IMG -->
                                <figure class="post-preview-img liquid">
                                    <img src="{{ $p['image'] }}" alt="post-02">
                                </figure>
                                <!-- /POST PREVIEW IMG -->

                                <!-- POST PREVIEW OVERLAY -->
                                <div class="post-preview-overlay">
                                    <!-- PLAY BUTTON -->
                                    <div class="play-button">
                                        <!-- PLAY BUTTON ICON -->
                                        <svg class="play-button-icon">
                                            <use xlink:href="#svg-play"></use>
                                        </svg>
                                        <!-- /PLAY BUTTON ICON -->
                                    </div>
                                    <!-- /PLAY BUTTON -->
                                </div>
                                <!-- /POST PREVIEW OVERLAY -->
                            </div>
                        </a>
                        <!-- /POST PREVIEW IMG WRAP -->

                        <!-- POST PREVIEW TITLE -->
                        <a href="{{ route('program.detail', $p['slug']) }}" class="post-preview-title">{{ $p['name'] }}</a>
                        <!-- POST AUTHOR INFO -->
                        <div class="post-author-info-wrap">
                            <p class="post-author-info small light">By <a href="#" class="post-author">{{ $p['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($p['created_at'])) }}</p>
                        </div>
                        <!-- /POST AUTHOR INFO -->
                        <!-- POST PREVIEW TEXT -->
                        <p class="post-preview-text">{{ Str::limit($p['body'], 100) }}</p>
                    </div>
                    @endforeach
                    <!-- /POST PREVIEW -->
                </div>
                <!-- /CAROUSEL ITEMS -->
            </div>
            <!-- /CAROUSEL -->
        </div>
        <!-- /LAYOUT ITEM -->

        <!-- LAYOUT ITEM -->
        @if(count(App\Helpers\CommonHelper::getFeaturedProgram(null)) > 0)
        <div class="layout-item padded own-grid">
            <!-- SECTION TITLE WRAP -->
            <div class="section-title-wrap cyan">
                <h2 class="section-title medium">Featured Program</h2>
                <div class="section-title-separator"></div>

                <!-- SLIDER CONTROLS -->
                <div id="lvideos-slider2-controls" class="carousel-controls slider-controls cyan">
                    <div class="slider-control control-previous">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                    <div class="slider-control control-next">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                </div>
                <!-- /SLIDER CONTROLS -->
            </div>
            <!-- /SECTION TITLE WRAP -->

            <!-- CAROUSEL -->
            <div id="lvideos-slider2" class="carousel video full">
                <!-- CAROUSEL ITEMS -->
                <div class="carousel-items">
                    <!-- POST PREVIEW -->
                    @foreach (App\Helpers\CommonHelper::getFeaturedProgram(null) as $featuredProgram)
                    <div class="post-preview video large no-hover">
                        <!-- POST PREVIEW IMG WRAP -->
                        <div class="post-preview-img-wrap">
                            <!-- POST PREVIEW IMG -->
                            <figure class="post-preview-img liquid">
                                <img src="{{ $featuredProgram['image'] }}" alt="post-03">
                            </figure>
                            <!-- /POST PREVIEW IMG -->

                            <!-- POST PREVIEW OVERLAY -->
                            <div class="post-preview-overlay">
                                <!-- PLAY BUTTON -->
                                <div class="play-button big">
                                    <!-- PLAY BUTTON ICON -->
                                    <svg class="play-button-icon big">
                                        <use xlink:href="#svg-play"></use>
                                    </svg>
                                    <!-- /PLAY BUTTON ICON -->
                                </div>
                                <!-- /PLAY BUTTON -->

                                <!-- POST PREVIEW OVERLAY INFO -->
                                <div class="post-preview-overlay-info">
                                    <!-- POST PREVIEW TITLE -->
                                    <p class="post-preview-title">{{ $featuredProgram['name'] }}</p>
                                    <!-- POST PREVIEW TEXT -->
                                    <p class="post-preview-text">{{ $featuredProgram['duration'] }}</p>
                                </div>
                                <!-- /POST PREVIEW OVERLAY INFO -->
                            </div>
                            <!-- /POST PREVIEW OVERLAY -->
                            @php
                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $featuredProgram['source'], $matches);
                            $youtubeId = $matches[1];
                            @endphp
                            <!-- POST PREVIEW VIDEO -->
                            <div class="post-preview-video-wrap">
                                <iframe class="post-preview-video" src="https://www.youtube.com/embed/{{ $youtubeId }}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <!-- /POST PREVIEW VIDEO -->
                        </div>
                        <!-- /POST PREVIEW IMG WRAP -->
                    </div>
                    @endforeach
                    <!-- /POST PREVIEW -->
                </div>
                <!-- /CAROUSEL ITEMS -->
            </div>
            <!-- /CAROUSEL -->
        </div>
        @endif
        <!-- /LAYOUT ITEM -->
    </div>
    <!-- /LAYOUT BODY -->

    <!-- LAYOUT SIDEBAR -->
    @include('templates.elements.sidebar')
    <!-- /LAYOUT SIDEBAR -->
</div>
<!-- /LAYOUT CONTENT 1 -->
@endsection