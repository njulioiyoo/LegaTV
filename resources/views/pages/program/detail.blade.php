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
    @include('templates.elements.sidebar')
    <!-- /LAYOUT SIDEBAR -->
</div>
<!-- /LAYOUT CONTENT 1 -->

@endsection