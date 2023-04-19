@extends('templates.layout')

@section('content')

@include('templates.elements.live-news')

<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 grid-limit">
    <!-- LAYOUT BODY -->
    <div class="layout-body">
        <!-- LAYOUT ITEM -->
        <div class="layout-item gutter-big">
            <!-- POST OPEN -->
            <div class="post-open game-review">
                <!-- POST OPEN CONTENT -->
                <div class="post-open-content v5">
                    <!-- POST OPEN BODY  -->
                    <div class="post-open-body">
                        <!-- POST OPEN MEDIA WRAP -->
                        <div class="post-open-media-wrap">
                            <!-- POST OPEN MEDIA -->
                            <div class="post-open-media">
                                <iframe src="https://www.youtube.com/embed/{{ $programDetail['source'] }}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <!-- /POST OPEN MEDIA -->
                        </div>
                        <!-- /POST OPEN MEDIA WRAP -->

                        <!-- TAG LIST -->
                        <div class="tag-list">
                            <!-- TAG ORNAMENT -->
                            <a href="#" class="tag-ornament video">{{ $programDetail['parent']->name }}</a>
                            <!-- /TAG ORNAMENT -->
                        </div>
                        <!-- /TAG LIST -->

                        <!-- POST OPEN TITLE -->
                        <p class="post-open-title small">{{ $programDetail['name'] }}</p>
                        <!-- /POST OPEN TITLE -->

                        <!-- POST AUTHOR INFO -->
                        <div class="post-author-info-wrap">
                            <!-- USER AVATAR -->
                            <a href="#">
                                <figure class="user-avatar tiny liquid">
                                    <img src="{{ asset('assets/img/users/04.jpg') }}" alt="user-04">
                                </figure>
                            </a>
                            <!-- /USER AVATAR -->
                            <p class="post-author-info small light">By <a href="#" class="post-author">{{ $programDetail['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($programDetail['created_at'])) }}</p>
                        </div>
                        <!-- /POST AUTHOR INFO -->

                        <!-- POST OPEN TEXT -->
                        <p class="post-open-text"><span class="video-length">{{ $programDetail['duration'] }}</span>{!! $programDetail['body'] !!}</p>
                        <!-- /POST OPEN TEXT -->

                        <!-- SOCIAL LINKS -->
                        <div class="social-links">
                            <!-- BUBBLE ORNAMENT -->
                            <a href="#" class="bubble-ornament fb">
                                <!-- FACEBOOK ICON -->
                                <svg class="facebook-icon">
                                    <use xlink:href="#svg-facebook"></use>
                                </svg>
                                <!-- /FACEBOOK ICON -->
                            </a>
                            <!-- /BUBBLE ORNAMENT -->

                            <!-- BUBBLE ORNAMENT -->
                            <a href="#" class="bubble-ornament twt">
                                <!-- TWITTER ICON -->
                                <svg class="twitter-icon">
                                    <use xlink:href="#svg-twitter"></use>
                                </svg>
                                <!-- /TWITTER ICON -->
                            </a>
                            <!-- /BUBBLE ORNAMENT -->
                        </div>
                        <!-- /SOCIAL LINKS -->
                    </div>
                    <!-- /POST OPEN BODY -->
                </div>
                <!-- /POST OPEN CONTENT -->
            </div>
            <!-- /POST OPEN -->
        </div>
        <!-- /LAYOUT ITEM -->
    </div>
    <!-- /LAYOUT BODY -->

    <!-- LAYOUT SIDEBAR -->
    <div class="layout-sidebar layout-item gutter-medium">
        <!-- WIDGET SIDEBAR -->
        <div class="widget-sidebar">
            <!-- SECTION TITLE WRAP -->
            <div class="section-title-wrap cyan">
                <h2 class="section-title medium">Related Videos</h2>
                <div class="section-title-separator"></div>
            </div>
            <!-- /SECTION TITLE WRAP -->

            <!-- POST PREVIEW SHOWCASE -->
            <div class="post-preview-showcase grid-1col centered gutter-small">
                <!-- POST PREVIEW -->
                @foreach($relatedProgram as $k => $rp)
                <div class="post-preview video gaming-news tiny no-hover">
                    <!-- POST PREVIEW IMG WRAP -->
                    <a href="{{ route('program.detail', $rp['slug']) }}">
                        <div class="post-preview-img-wrap">
                            <!-- POST PREVIEW IMG -->
                            <figure class="post-preview-img liquid">
                                <img src="{{ $rp['image'] }}" alt="post-13">
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
                                <p class="timestamp-tag tiny">{{ $rp['duration'] }}</p>
                                <!-- /TIMESTAMP TAG -->
                            </div>
                            <!-- /POST PREVIEW OVERLAY -->
                        </div>
                    </a>
                    <!-- /POST PREVIEW IMG WRAP -->

                    <!-- POST PREVIEW TITLE -->
                    <a href="{{ route('program.detail', $rp['slug']) }}" class="post-preview-title">{{ Str::limit($rp['name'], 65) }}</a>
                    <!-- POST AUTHOR INFO -->
                    <div class="post-author-info-wrap">
                        <p class="post-author-info small light">By <a href="#" class="post-author">{{ $rp['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($rp['created_at'])) }}</p>
                    </div>
                    <!-- /POST AUTHOR INFO -->
                </div>
                @endforeach
                <!-- /POST PREVIEW -->
            </div>
            <!-- /POST PREVIEW SHOWCASE -->
        </div>
        <!-- /WIDGET SIDEBAR -->
    </div>
    <!-- /LAYOUT SIDEBAR -->
</div>
<!-- /LAYOUT CONTENT 1 -->

@endsection