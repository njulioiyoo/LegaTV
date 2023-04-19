<!-- LIVE NEWS WIDGET WRAP -->
@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
$liveNews = App\Helpers\CommonHelper::getLiveNews();
@endphp
@if($configurations['status_live_news'] == '1')
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
        @foreach ($liveNews as $item)
        <div id="my-marquee">
            <marquee behavior="scroll" direction="left" class="live-news-widget-text-wrap">
                <p class="live-news-widget-text"><a href="{{ route('news.detail', $item['slug']) }}" style="color: #fff">{{ $item['name'] }}:</a> <span>{{ $item['description'] }}</span></p>
            </marquee>
        </div>
        @endforeach
    </div>

    <!-- /LIVE NEWS WIDGET TEXT WRAP -->
</div>
<!-- /LIVE NEWS WIDGET -->
</div>
@endif
<!-- /LIVE NEWS WIDGET WRAP -->

@push('script')
<script>
    var myMarquee = document.getElementById('my-marquee');
    var marquee = myMarquee.getElementsByTagName('marquee')[0];

    myMarquee.addEventListener('mouseover', function() {
        marquee.stop();
    });

    myMarquee.addEventListener('mouseout', function() {
        marquee.start();
    });
</script>
@endpush