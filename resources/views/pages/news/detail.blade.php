@extends('templates.layout')

@section('meta-name')
<meta name="title" content="{{ $newsDetail['name'] }}">
<meta name="keywords" content="{{ Str::limit($newsDetail['body'], 100) }}">
<meta name="description" content="{{ $newsDetail['body'] }}">
@endsection

@section('title', $newsDetail['name'])

@section('content')

@include('templates.elements.live-news')

<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 grid-limit">
    <!-- LAYOUT BODY -->
    <div class="layout-body">
        <!-- LAYOUT ITEM -->
        <div class="layout-item gutter-big">
            <!-- POST OPEN -->
            <div class="post-open movie-news">
                <!-- POST OPEN CONTENT -->
                <div class="post-open-content v3">
                    <!-- POST OPEN BODY  -->
                    <div class="post-open-body">
                        <!-- POST OPEN IMG WRAP -->
                        <div class="post-open-img-wrap">
                            @if(!empty($newsDetail['source']))
                            @php
                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $newsDetail['source'], $matches);
                            $youtubeId = $matches[1];
                            @endphp
                            <div class="video-container">
                                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            @else
                            <!-- POST OPEN IMG -->
                            <figure class="post-open-img liquid">
                                <img src="{{ $newsDetail['image'] }}" alt="post-12">
                            </figure>
                            <!-- /POST OPEN IMG -->
                            @endif

                            <!-- TAG ORNAMENT -->
                            <!-- <a href="#" class="tag-ornament">{{ $newsDetail['parent']->name }}</a> -->
                            <!-- /TAG ORNAMENT -->
                        </div>
                        <!-- /POST OPEN IMG WRAP -->

                        <!-- POST OPEN TITLE -->
                        <p class="post-open-title">{{ $newsDetail['name'] }}</p>
                        <!-- /POST OPEN TITLE -->

                        <!-- POST OPEN CONTENT -->
                        <div class="post-open-content v4">
                            <!-- POST OPEN BODY  -->
                            <div class="post-open-body">
                                {!! $newsDetail['body'] !!}
                            </div>
                            <!-- /POST OPEN BODY -->

                            <!-- POST OPEN SIDEBAR -->
                            <div class="post-open-sidebar">

                                <!-- FEATURE LIST -->
                                <div class="feature-list">
                                    <!-- FEATURE LIST ITEM -->
                                    <p class="feature-list-item"><span class="feature-title">Date</span><span class="feature-info">{{ date('F jS, Y', strtotime($newsDetail['created_at'])) }}</span></p>
                                    <!-- /FEATURE LIST ITEM -->

                                    <!-- FEATURE LIST ITEM -->
                                    <p class="feature-list-item"><span class="feature-title">Author</span><span class="feature-info">{{ $newsDetail['user']->name }}</span></p>
                                    <!-- /FEATURE LIST ITEM -->
                                </div>
                                <!-- /FEATURE LIST -->
                            </div>
                            <!-- /POST OPEN SIDEBAR -->
                        </div>
                        <!-- /POST OPEN CONTENT -->
                    </div>
                    <!-- /POST OPEN BODY -->
                    <!-- POST OPEN SIDEBAR -->
                    <div class="post-open-sidebar">
                        @php
                        $getFacebookShareCount = App\Helpers\CommonHelper::getFacebookShareCount();
                        $getTwitterShareCount = App\Helpers\CommonHelper::getTwitterShareCount();
                        $getWhatsappShareCount = App\Helpers\CommonHelper::getWhatsappShareCount();
                        @endphp
                        <!-- SOCIAL LINKS -->
                        <div class="social-links medium vertical animated">
                            <!-- BUBBLE ORNAMENT -->
                            <a href="#" class="bubble-ornament big fb" data-url="{{ url()->current() }}" data-social="facebook">
                                <!-- FACEBOOK ICON -->
                                <svg class="facebook-icon big">
                                    <use xlink:href="#svg-facebook"></use>
                                </svg>
                                <!-- /FACEBOOK ICON -->
                                <p class="bubble-ornament-text">{{ $getFacebookShareCount }}</p>
                                <p class="bubble-ornament-text hover-replace">Share</p>
                            </a>
                            <!-- /BUBBLE ORNAMENT -->

                            <!-- BUBBLE ORNAMENT -->
                            <a href="#" class="bubble-ornament big twt" data-url="{{ url()->current() }}" data-social="twitter">
                                <!-- TWITTER ICON -->
                                <svg class="twitter-icon big">
                                    <use xlink:href="#svg-twitter"></use>
                                </svg>
                                <!-- /TWITTER ICON -->
                                <p class="bubble-ornament-text">{{ $getTwitterShareCount }}</p>
                                <p class="bubble-ornament-text hover-replace">Share</p>
                            </a>
                            <!-- /BUBBLE ORNAMENT -->
                        </div>
                        <!-- /SOCIAL LINKS -->
                    </div>
                    <!-- /POST OPEN SIDEBAR -->
                </div>
                <!-- /POST OPEN CONTENT -->
            </div>
            <!-- /POST OPEN -->

            <!-- WIDGET NEWS -->
            @if(count($relatedNews) > 0)
            <div class="widget-news">
                <!-- SECTION TITLE WRAP -->
                <div class="section-title-wrap blue">
                    <h2 class="section-title medium">Related News</h2>
                    <div class="section-title-separator"></div>
                </div>
                <!-- /SECTION TITLE WRAP -->

                <!-- POST PREVIEW SHOWCASE -->
                <div class="post-preview-showcase grid-3col centered">
                    <!-- POST PREVIEW -->
                    @foreach($relatedNews as $k => $r)
                    <div class="post-preview gaming-news">
                        <!-- POST PREVIEW IMG WRAP -->
                        <a href="{{ route('news.detail', $r['slug']) }}">
                            <div class="post-preview-img-wrap">
                                <!-- POST PREVIEW IMG -->
                                <figure class="post-preview-img liquid">
                                    <img src="{{ $r['image'] }}" alt="post-09">
                                </figure>
                                <!-- /POST PREVIEW IMG -->
                            </div>
                        </a>
                        <!-- /POST PREVIEW IMG WRAP -->

                        <!-- TAG ORNAMENT -->
                        <!-- <a href="#" class="tag-ornament">{{ $r['parent']->name }}</a> -->
                        <!-- /TAG ORNAMENT -->

                        <!-- POST PREVIEW TITLE -->
                        <a href="{{ route('news.detail', $r['slug']) }}" class="post-preview-title">{{ $r['name'] }}</a>
                        <!-- POST AUTHOR INFO -->
                        <div class="post-author-info-wrap">
                            <p class="post-author-info small light">By <a href="#" class="post-author">{{ $r['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($r['created_at'])) }}</p>
                        </div>
                        <!-- /POST AUTHOR INFO -->
                        <!-- POST PREVIEW TEXT -->
                        <p class="post-preview-text">{{ $r['description'] }}</p>
                    </div>
                    @endforeach
                    <!-- /POST PREVIEW -->
                </div>
                <!-- /POST PREVIEW SHOWCASE -->
            </div>
            @endif
            <!-- /WIDGET NEWS -->
        </div>
        <!-- /LAYOUT ITEM -->
    </div>
    <!-- /LAYOUT BODY -->

    <!-- LAYOUT SIDEBAR -->
    @include('templates.elements.sidebar')
    <!-- /LAYOUT SIDEBAR -->
</div>
<!-- /LAYOUT CONTENT 1 -->
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('.bubble-ornament.big');

        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var shareUrl = this.dataset.url;
                var socialMedia = this.dataset.social;

                // Buat objek XMLHTTPRequest
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/update-share-count');
                xhr.setRequestHeader('Content-Type', 'application/json');

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                // Tangani respons dari server
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        // Tanggapi respons dari server (jika ada)
                        console.log('Response:', response);

                        // Perbarui tampilan jumlah berbagi dengan respons yang diterima
                        var shareCountElement = button.querySelector('.bubble-ornament-text');
                        shareCountElement.textContent = response.share_count;
                    } else {
                        console.error('Error:', xhr.status);
                    }
                };

                // Tangani kesalahan koneksi
                xhr.onerror = function() {
                    console.error('Request failed.');
                };

                // Kirim permintaan untuk memperbarui jumlah berbagi
                xhr.send(JSON.stringify({
                    social_media: socialMedia,
                    share_url: shareUrl
                }));

                // Contoh penggunaan: Membuka jendela pop-up share Facebook atau Twitter
                if (socialMedia === 'facebook') {
                    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl), 'Share on Facebook', 'width=600,height=400');
                } else if (socialMedia === 'twitter') {
                    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl), 'Share on Twitter', 'width=600,height=400');
                } else if (socialMedia === 'whatsapp') {
                    var whatsappMessage = 'Check out this link: ' + shareUrl;
                    window.location.href = 'whatsapp://send?text=' + encodeURIComponent(whatsappMessage);
                }
            });
        });
    });
</script>
@endpush