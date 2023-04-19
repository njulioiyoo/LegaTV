<!-- LIVE NEWS WIDGET WRAP -->
@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp
@if($configurations['website_live_news'] == '1')
<div class="live-news-widget-wrap">
    <!-- LIVE NEWS WIDGET -->
    <div class="live-news-widget grid-limit">
        <!-- LIVE NEWS WIDGET STAIRS -->
        <div class="live-news-widget-stairs left red">
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
        </div>
        <!-- /LIVE NEWS WIDGET STAIRS -->

        <!-- LIVE NEWS WIDGET STAIRS -->
        <div class="live-news-widget-stairs right blue">
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
            <div class="live-news-widget-stair"></div>
        </div>
        <!-- /LIVE NEWS WIDGET STAIRS -->

        <!-- LIVE NEWS WIDGET TITLE WRAP -->
        <div class="live-news-widget-title-wrap">
            <img class="live-news-widget-icon" src="{{ asset('assets/img/icons/live-news-icon.png') }}" alt="live-news-icon">
            <p class="live-news-widget-title">Live News</p>
        </div>
        <!-- /LIVE NEWS WIDGET TITLE WRAP -->

        <!-- LIVE NEWS WIDGET TEXT WRAP -->
        <div id="lineslide-wrap1" class="live-news-widget-text-wrap">
            <p class="live-news-widget-text"></p>
        </div>
        <!-- /LIVE NEWS WIDGET TEXT WRAP -->
    </div>
    <!-- /LIVE NEWS WIDGET -->
</div>
@endif
<!-- /LIVE NEWS WIDGET WRAP -->