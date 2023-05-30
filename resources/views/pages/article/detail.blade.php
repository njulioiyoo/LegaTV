@extends('templates.layout')

@section('meta-name')
<meta name="title" content="{{ $articleDetail['name'] }}">
<meta name="keywords" content="{{ Str::limit($articleDetail['body'], 100) }}">
<meta name="description" content="{{ $articleDetail['body'] }}">
@endsection

@section('title', $articleDetail['name'])

@section('content')

@include('templates.elements.live-news')
<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 grid-limit">
    <!-- LAYOUT BODY -->
    <div class="layout-body">
        <!-- LAYOUT ITEM -->
        <div class="layout-item gutter-big">
            <!-- POST OPEN -->
            <div class="post-open gaming-news">
                <!-- POST OPEN IMG -->
                <figure class="post-open-img liquid">
                    <img src="{{ $articleDetail['image'] }}" alt="post-13">
                </figure>
                <!-- /POST OPEN IMG -->

                <!-- POST OPEN CONTENT -->
                <div class="post-open-content">
                    <!-- POST OPEN BODY  -->
                    <div class="post-open-body">
                        <!-- TAG LIST -->
                        <!-- <div class="tag-list">
                            <a href="#" class="tag-ornament">{{ $articleDetail['parent']->name }}</a>
                        </div> -->
                        <!-- /TAG LIST -->

                        <!-- POST OPEN TITLE -->
                        <p class="post-open-title">{{ $articleDetail['name'] }}</p>
                        <!-- /POST OPEN TITLE -->

                        <!-- POST OPEN TEXT -->
                        <p class="post-open-text bold">{!! $articleDetail['body'] !!}</p>
                        <!-- /POST OPEN TEXT -->
                    </div>
                    <!-- /POST OPEN BODY -->
                    <!-- POST OPEN SIDEBAR -->
                    <div class="post-open-sidebar">

                        <!-- FEATURE LIST -->
                        <div class="feature-list">
                            <!-- FEATURE LIST ITEM -->
                            <p class="feature-list-item"><span class="feature-title">Date</span><span class="feature-info">{{ date('F jS, Y', strtotime($articleDetail['created_at'])) }}</span></p>
                            <!-- /FEATURE LIST ITEM -->

                            <!-- FEATURE LIST ITEM -->
                            <p class="feature-list-item"><span class="feature-title">Author</span><span class="feature-info">{{ $articleDetail['user']->name }}</span></p>
                            <!-- /FEATURE LIST ITEM -->
                        </div>
                        <!-- /FEATURE LIST -->
                    </div>
                    <!-- /POST OPEN SIDEBAR -->
                </div>
                <!-- /POST OPEN CONTENT -->
            </div>
            <!-- /POST OPEN -->

            <!-- WIDGET NEWS -->
            @if(count($relatedArticle) > 0)
            <div class="widget-news">
                <!-- SECTION TITLE WRAP -->
                <div class="section-title-wrap blue">
                    <h2 class="section-title medium">Related Article</h2>
                    <div class="section-title-separator"></div>
                </div>
                <!-- /SECTION TITLE WRAP -->

                <!-- POST PREVIEW SHOWCASE -->
                <div class="post-preview-showcase grid-3col centered">
                    <!-- POST PREVIEW -->
                    @foreach($relatedArticle as $k => $r)
                    <div class="post-preview gaming-news">
                        <!-- POST PREVIEW IMG WRAP -->
                        <a href="{{ route('article.detail', $r['slug']) }}">
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