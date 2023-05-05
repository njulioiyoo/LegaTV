@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp
<div class="layout-sidebar layout-item gutter-medium">
    <!-- WIDGET SIDEBAR -->
    <div class="widget-sidebar">
        <!-- SECTION TITLE WRAP -->
        <div class="section-title-wrap blue">
            <h2 class="section-title medium">Popular News</h2>
            <div class="section-title-separator"></div>
        </div>
        <!-- /SECTION TITLE WRAP -->

        <!-- POST PREVIEW SHOWCASE -->
        <div class="post-preview-showcase grid-1col centered gutter-small">
            <!-- POST PREVIEW -->
            @foreach(App\Helpers\CommonHelper::getPopularNews(null) as $k => $p)
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
        <!-- SECTION TITLE WRAP -->
        <div class="section-title-wrap cyan">
            <h2 class="section-title medium">Popular Program</h2>
            <div class="section-title-separator"></div>
        </div>
        <!-- /SECTION TITLE WRAP -->

        <!-- POST PREVIEW SHOWCASE -->
        <div class="post-preview-showcase grid-1col centered gutter-small">
            <!-- POST PREVIEW -->
            @foreach(App\Helpers\CommonHelper::getPopularProgram(null) as $k => $pp)
            <div class="post-preview video gaming-news tiny no-hover">
                <!-- POST PREVIEW IMG WRAP -->
                <a href="{{ route('program.detail', $pp['slug']) }}">
                    <div class="post-preview-img-wrap">
                        <!-- POST PREVIEW IMG -->
                        <figure class="post-preview-img liquid">
                            <img src="{{ $pp['image'] }}" alt="post-13">
                        </figure>
                        <!-- /POST PREVIEW IMG -->

                        <!-- POST PREVIEW OVERLAY -->
                        <div class="post-preview-overlay">
                            <!-- PLAY BUTTON -->
                            <div class="play-button tiny">
                                <!-- PLAY BUTTON ICON -->
                                <svg class="play-button-icon tiny">
                                    <use xlink:href="#svg-play"></use>
                                </svg>
                                <!-- /PLAY BUTTON ICON -->
                            </div>
                            <!-- /PLAY BUTTON -->

                            <!-- TIMESTAMP TAG -->
                            <p class="timestamp-tag tiny">{{ $pp['duration'] }}</p>
                            <!-- /TIMESTAMP TAG -->
                        </div>
                        <!-- /POST PREVIEW OVERLAY -->
                    </div>
                </a>
                <!-- /POST PREVIEW IMG WRAP -->

                <!-- POST PREVIEW TITLE -->
                <a href="{{ route('program.detail', $pp['slug']) }}" class="post-preview-title">{{ Str::limit($pp['name'], 65) }}</a>
                <!-- POST AUTHOR INFO -->
                <div class="post-author-info-wrap">
                    <p class="post-author-info small light">By <a href="#" class="post-author">{{ $pp['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($pp['created_at'])) }}</p>
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
    @if(!empty($configurations['promo_ad_250x250']))
    <div class="widget-sidebar">
        <!-- PROMO ADVERT -->
        <div class="promo-advert">
            <a href="#">
                <!-- PROMO ADVERT IMG -->
                <img class="promo-advert-img" src="{{ asset($configurations['promo_ad_250x250']) }}" alt="promo-ad-1">
                <!-- /PROMO ADVERT IMG -->
            </a>
        </div>
        <!-- /PROMO ADVERT -->
    </div>
    @endif
    <!-- /WIDGET SIDEBAR -->

    @if(request()->route()->getName() != 'news')
    <div class="widget-sidebar">
        <!-- SECTION TITLE WRAP -->
        <div class="section-title-wrap red">
            <h2 class="section-title medium">Latest News</h2>
            <div class="section-title-separator"></div>
        </div>
        <!-- /SECTION TITLE WRAP -->

        <!-- POST PREVIEW SHOWCASE -->
        <div class="post-preview-showcase grid-1col centered gutter-small">
            <!-- POST PREVIEW -->
            @foreach (App\Helpers\CommonHelper::getLatestNews(null) as $latestNews)
            <div class="post-preview tiny game-review">
                <!-- POST PREVIEW IMG WRAP -->
                <a href="{{ route('news.detail', $latestNews['slug']) }}">
                    <div class="post-preview-img-wrap">
                        <!-- POST PREVIEW IMG -->
                        <figure class="post-preview-img liquid">
                            <img src="{{ $latestNews['image'] }}" alt="post-16">
                        </figure>
                        <!-- /POST PREVIEW IMG -->
                    </div>
                </a>
                <!-- /POST PREVIEW IMG WRAP -->

                <!-- POST PREVIEW TITLE -->
                <a href="{{ route('news.detail', $latestNews['slug']) }}" class="post-preview-title">{{ Str::limit($latestNews['name'], 65) }}</a>
                <!-- POST AUTHOR INFO -->
                <div class="post-author-info-wrap">
                    <p class="post-author-info small light">By <a href="#" class="post-author">{{ $latestNews['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($latestNews['created_at'])) }}</p>
                </div>
                <!-- /POST AUTHOR INFO -->
            </div>
            @endforeach
            <!-- /POST PREVIEW -->
        </div>
        <!-- /POST PREVIEW SHOWCASE -->
    </div>
    @endif
</div>