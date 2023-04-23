@extends('templates.layout')

@push('css')
<style>
    body {
        margin: 0;
        padding: 0;
    }

    video {
        width: 100%;
        height: 100%;
    }
</style>
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
            <video id="videoPlayer" autoplay controls></video>
        </div>
    </div>
    <!-- /WIDGET ITEM -->
    @endif

    <!-- WIDGET ITEM ITEM -->
    @if(count($program) > 0)
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
                @php
                $postHtml = '';
                $postCounter = 0;

                foreach ($program as $k => $p) {
                if($postCounter % 2 == 0) {
                $postHtml .= '<div class="carousel-item">';
                    }

                    $postHtml .= '<div class="post-preview video gaming-news no-hover">';
                        $postHtml .= '<!-- POST PREVIEW IMG WRAP -->';
                        $postHtml .= '<a href="' . route('program.detail', $p['slug']) . '">';
                            $postHtml .= '<div class="post-preview-img-wrap">';
                                $postHtml .= '<!-- POST PREVIEW IMG -->';
                                $postHtml .= '<figure class="post-preview-img liquid">';
                                    $postHtml .= '<img src="' . $p['image'] . '" alt="post-31">';
                                    $postHtml .= '</figure>';
                                $postHtml .= '<!-- /POST PREVIEW IMG -->';

                                $postHtml .= '<!-- POST PREVIEW OVERLAY -->';
                                $postHtml .= '<div class="post-preview-overlay">';
                                    $postHtml .= '<!-- PLAY BUTTON -->';
                                    $postHtml .= '<div class="play-button">';
                                        $postHtml .= '<!-- PLAY BUTTON ICON -->';
                                        $postHtml .= '<svg class="play-button-icon">';
                                            $postHtml .= '<use xlink:href="#svg-play"></use>';
                                            $postHtml .= '</svg>';
                                        $postHtml .= '<!-- /PLAY BUTTON ICON -->';
                                        $postHtml .= '</div>';
                                    $postHtml .= '<!-- /PLAY BUTTON -->';
                                    $postHtml .= '</div>';
                                $postHtml .= '<!-- /POST PREVIEW OVERLAY -->';
                                $postHtml .= '</div>';
                            $postHtml .= '</a>';
                        $postHtml .= '<!-- /POST PREVIEW IMG WRAP -->';

                        $postHtml .= '<!-- POST PREVIEW TITLE -->';
                        $postHtml .= '<a href="' . route('program.detail', $p['slug']) . '" class="post-preview-title">' . $p['name'] . '</a>';

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
                $postHtml .= '</div>';
            }
            @endphp

            {!! $postHtml !!}
        </div>
        <!-- /CAROUSEL ITEMS -->
    </div>
    @endif
    <!-- /CAROUSEL -->
</div>
<!-- /WIDGET ITEM ITEM -->
</div>
<!-- /LAYOUT CONTENT FULL -->

@endsection

@push('script')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
    var videoSource = '{{ $configurations['live_tv'] }}';
    if (Hls.isSupported()) {
        var video = document.getElementById('videoPlayer');
        var hls = new Hls();
        hls.loadSource(videoSource);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, function() {
            video.play();
        });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = videoSource;
        video.addEventListener('loadedmetadata', function() {
            video.play();
        });
    }
</script>
@endpush