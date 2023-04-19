@extends('templates.layout')

@push('css')
<link rel="stylesheet" href="https://cdn.plyr.io/3.4.6/plyr.css">
@endpush

@section('content')

@include('templates.elements.live-news')

@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp
<!-- LAYOUT CONTENT FULL -->
<div class="layout-content-full grid-limit layout-item gutter-big">
    @if($configurations['status_live_tv'] == '1')
    <!-- WIDGET ITEM -->
    <div class="widget-item ">
        <!-- SECTION TITLE WRAP -->
        <div class="section-title-wrap violet">
            <h2 class="section-title medium">Live Lega TV</h2>
            <div class="section-title-separator"></div>
        </div>
        <!-- /SECTION TITLE WRAP -->
        <div class="container">
            <video id="my-video" class="video-js vjs-default-skin" controls preload="auto" height="500">
                <source src="{{ $configurations['live_tv'] }}" type="application/x-mpegURL" />
            </video>
        </div>
    </div>
    <!-- /WIDGET ITEM -->
    @endif

    <!-- WIDGET ITEM ITEM -->
    <div class="widget-item">
        <!-- SECTION TITLE WRAP -->
        <div class="section-title-wrap violet">
            <h2 class="section-title medium">Browse Program</h2>
            <div class="section-title-separator"></div>

            <!-- SLIDER CONTROLS -->
            <div id="st-videos-slider-controls" class="carousel-controls slider-controls violet">
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
        <div id="st-videos-slider" class="carousel big st-video">
            <!-- CAROUSEL ITEMS -->
            <div class="carousel-items">
                <!-- CAROUSEL ITEM -->
                @php
                $postHtml = '';
                $postCounter = 0;

                foreach ($program as $k => $p) {
                if($postCounter % 2 == 0) {
                $postHtml .= '<div class="carousel-item">';
                    }
                    $postHtml .= '<div class="post-preview e-sport">';
                        $postHtml .= '<!-- POST PREVIEW ST VIDEO -->';
                        $postHtml .= '<div class="post-preview-st-video">';
                            $postHtml .= '<iframe src="https://www.youtube.com/embed/' . $p['source'] . '" allowfullscreen></iframe>';
                            $postHtml .= '</div>';
                        $postHtml .= '<!-- /POST PREVIEW ST VIDEO -->';
                        $postHtml .= '<!-- POST PREVIEW TITLE -->';
                        $postHtml .= '<p class="post-preview-title">' . Str::limit($p['name'], 30) . '</p>';
                        $postHtml .= '<!-- POST AUTHOR INFO -->';
                        $postHtml .= '<div class="post-author-info-wrap">';
                            $postHtml .= '<p class="post-author-info small light">By <a href="#" class="post-author">' . $p['user']->name . '</a><span class="separator">|</span>' . date('F jS, Y', strtotime($p['created_at'])) . '</p>';
                            $postHtml .= '</div>';
                        $postHtml .= '<!-- /POST AUTHOR INFO -->';
                        $postHtml .= '</div>';
                    $postCounter++;

                    if($postCounter % 2 == 0) {
                    $postHtml .= '</div>';
                }
                }
                if($postCounter % 2 == 1) {
                $postHtml .= '
            </div>';
            }
            @endphp

            {!! $postHtml !!}
            <!-- /CAROUSEL ITEM -->
        </div>
        <!-- /CAROUSEL ITEMS -->
    </div>
    <!-- /CAROUSEL -->
</div>
<!-- /WIDGET ITEM ITEM -->
</div>
<!-- /LAYOUT CONTENT FULL -->

@endsection

@push('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Load library video.js CSS -->
<link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
<!-- Load library video.js JS -->
<script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
<!-- Load video.js HLS plugin -->
<script src="https://cdn.jsdelivr.net/npm/videojs-contrib-hls@5.15.0/dist/videojs-contrib-hls.min.js"></script>

<script src="https://cdn.plyr.io/3.4.6/plyr.js"></script>

<script>
    // Inisialisasi video player
    var player = videojs("my-video");

    // Gunakan video.js HLS plugin untuk memutar format M3U8
    player.play();

    // Optional: atur volume ke nilai tertentu
    player.volume(0.5);
</script>
@endpush