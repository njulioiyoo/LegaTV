@extends('templates.layout')

@section('content')

<!-- BANNER WRAP -->
<div class="banner-wrap geeky-news">
    <!-- BANNER -->
    <div class=" banner grid-limit">
        <h2 class="banner-title">Program</h2>
        <p class="banner-sections">
            <span class="banner-section">Home</span>
            <!-- ARROW ICON -->
            <svg class="arrow-icon">
                <use xlink:href="#svg-arrow"></use>
            </svg>
            <!-- /ARROW ICON -->
            <span class="banner-section">Program</span>
        </p>
    </div>
    <!-- /BANNER -->
</div>
<!-- /BANNER WRAP -->

@include('templates.elements.live-news')

<!-- LAYOUT CONTENT 1 -->
<div class="layout-content-1 layout-item-3-1 grid-limit">
    <!-- LAYOUT BODY -->
    @if(count($program) > 0)
    <div class="layout-body">
        <!-- SECTION TITLE WRAP -->
        <div class="section-title-wrap cyan small-space">
            <h2 class="section-title medium">Browse Program</h2>
            <div class="section-title-separator"></div>
        </div>
        <!-- /SECTION TITLE WRAP -->

        <!-- POST PREVIEW SHOWCASE -->
        <div class="post-preview-showcase grid-3col centered">
            <!-- POST PREVIEW -->
            @foreach($program as $k => $p)
            <div class="post-preview video gaming-news no-hover">
                <!-- POST PREVIEW IMG WRAP -->
                <a href="{{ route('program.detail', $p['slug']) }}">
                    <div class="post-preview-img-wrap">
                        <!-- POST PREVIEW IMG -->
                        <figure class="post-preview-img liquid">
                            <img src="{{ $p['image'] }}" alt="post-31">
                        </figure>
                        <!-- /POST PREVIEW IMG -->

                        <!-- POST PREVIEW OVERLAY -->
                        <div class="post-preview-overlay">
                            <!-- PLAY BUTTON -->
                            <div class="play-button">
                                <!-- PLAY BUTTON ICON -->
                                <svg class="play-button-icon">
                                    <use xlink:href="#svg-play"></use>
                                </svg>
                                <!-- /PLAY BUTTON ICON -->
                            </div>
                            <!-- /PLAY BUTTON -->
                        </div>
                        <!-- /POST PREVIEW OVERLAY -->
                    </div>
                </a>
                <!-- /POST PREVIEW IMG WRAP -->

                <!-- TAG LIST -->
                <div class="tag-list">
                    <a href="#" class="tag-ornament video">{{ $p['parent']->name }}</a>
                </div>
                <!-- /TAG LIST -->

                <!-- POST PREVIEW TITLE -->
                <a href="{{ route('program.detail', $p['slug']) }}" class="post-preview-title">{{ $p['name'] }}</a>
                <!-- POST AUTHOR INFO -->
                <div class="post-author-info-wrap">
                    <p class="post-author-info small light">By <a href="#" class="post-author">{{ $p['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($p['created_at'])) }}</p>
                </div>
                <!-- /POST AUTHOR INFO -->
                <!-- POST PREVIEW TEXT -->
                <p class="post-preview-text">{{ Str::limit($p['body'], 100) }}</p>
            </div>
            @endforeach
            <!-- /POST PREVIEW -->
        </div>
        <!-- /POST PREVIEW SHOWCASE -->

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
            @for ($i = 1; $i <= $program->lastPage(); $i++)
                <a href="{{ $program->url($i) }}" class="page-navigation-item{{ $program->currentPage() === $i ? ' active' : '' }}">{{ $i }}</a>
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
    <div class="layout-sidebar layout-item gutter-medium">
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
                @foreach($popularProgram as $k => $pp)
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
    </div>
    <!-- /LAYOUT SIDEBAR -->
    @endif
</div>
<!-- /LAYOUT CONTENT 1 -->

@endsection