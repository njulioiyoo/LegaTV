@extends('templates.layout')

@section('content')

<!-- BANNER WRAP -->
<div class="banner-wrap geeky-news">
    <!-- BANNER -->
    <div class=" banner grid-limit">
        <h2 class="banner-title">Article</h2>
        <p class="banner-sections">
            <span class="banner-section">Home</span>
            <!-- ARROW ICON -->
            <svg class="arrow-icon">
                <use xlink:href="#svg-arrow"></use>
            </svg>
            <!-- /ARROW ICON -->
            <span class="banner-section">Article</span>
        </p>
    </div>
    <!-- /BANNER -->
</div>
<!-- /BANNER WRAP -->

@include('templates.elements.live-news')

<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 grid-limit">
    <!-- LAYOUT BODY -->
    @if(count($article) > 0)
    <div class="layout-body">
        <!-- LAYOUT ITEM -->
        <div class="layout-item gutter-big">
            <!-- POST PREVIEW -->
            @foreach($article as $k => $a)
            <div class="post-preview large gaming-news">
                <!-- POST PREVIEW IMG WRAP -->
                <a href="{{ route('article.detail', $a['slug']) }}">
                    <div class="post-preview-img-wrap">
                        <!-- POST PREVIEW IMG -->
                        <figure class="post-preview-img liquid">
                            <img src="{{ $a['image'] }}" alt="post-13">
                        </figure>
                        <!-- POST PREVIEW IMG -->
                    </div>
                </a>
                <!-- /POST PREVIEW IMG WRAP -->

                <!-- TAG ORNAMENT -->
                <a href="#" class="tag-ornament">{{ $a['parent']->name }}</a>
                <!-- /TAG ORNAMENT -->

                <!-- POST PREVIEW TITLE -->
                <a href="{{ route('article.detail', $a['slug']) }}" class="post-preview-title">{{ $a['name'] }}</a>
                <!-- POST AUTHOR INFO -->
                <div class="post-author-info-wrap">
                    <!-- USER AVATAR -->
                    <a href="#">
                        <figure class="user-avatar tiny liquid">
                            <img src="{{ asset('assets/img/users/03.jpg') }}" alt="user-01">
                        </figure>
                    </a>
                    <!-- /USER AVATAR -->
                    <p class="post-author-info small light">By <a href="#" class="post-author">{{ $a['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($a['created_at'])) }}</p>
                </div>
                <!-- /POST AUTHOR INFO -->
                <!-- POST PREVIEW TEXT -->
                <p class="post-preview-text">{!! Str::limit($a['body'], 200) !!}</p>
            </div>
            @endforeach
            <!-- /POST PREVIEW -->
        </div>
        <!-- /LAYOUT ITEM -->

        <!-- PAGE NAVIGATION -->
        <div class="page-navigation green center spaced">
            <!-- CONTROL PREVIOUS -->
            <div class="slider-control big control-previous">
                <!-- ARROW ICON -->
                <svg class="arrow-icon medium">
                    <use xlink:href="#svg-arrow-medium"></use>
                </svg>
                <!-- /ARROW ICON -->
            </div>
            <!-- /CONTROL PREVIOUS -->
            @for ($i = 1; $i <= $article->lastPage(); $i++)
                <a href="{{ $article->url($i) }}" class="page-navigation-item{{ $article->currentPage() === $i ? ' active' : '' }}">{{ $i }}</a>
                @endfor
                <!-- CONTROL PREVIOUS -->
                <div class="slider-control big control-next">
                    <!-- ARROW ICON -->
                    <svg class="arrow-icon medium">
                        <use xlink:href="#svg-arrow-medium"></use>
                    </svg>
                    <!-- /ARROW ICON -->
                </div>
                <!-- /CONTROL PREVIOUS -->
        </div>

        <!-- PAGINATION SCRIPT -->
        @push('scripts')
        <script>
            var paginationLinks = document.querySelectorAll('.page-navigation-item');
            for (var i = 0; i < paginationLinks.length; i++) {
                paginationLinks[i].addEventListener('click', function(event) {
                    event.preventDefault();
                    var url = this.getAttribute('href');
                });
            }
        </script>
        @endpush
    </div>
    <!-- /LAYOUT BODY -->

    <!-- LAYOUT SIDEBAR -->
    @include('templates.elements.sidebar')
    <!-- /LAYOUT SIDEBAR -->
    @endif
</div>
<!-- /LAYOUT CONTENT 1 -->

@endsection