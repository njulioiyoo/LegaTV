@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp
<!-- FOOTER TOP WRAP -->
<div class="footer-top-wrap">
    <!-- FOOTER TOP -->
    <div class="footer-top grid-limit">
        <!-- FOOTER TOP BRAND -->
        <div class="footer-top-brand">
            <!-- LOGO -->
            <div class="logo negative">
                <!-- LOGO IMG -->
                <figure class="logo-img">
                    <img src="{{ $configurations['website_logo'] ? asset($configurations['website_logo']) : 'https://via.placeholder.com/1000x476.png?text=No+Image' }}" alt="Logo">
                </figure>
                <!-- /LOGO IMG -->
            </div>
            <!-- /LOGO -->

            <!-- SPONSORS SLIDER WRAP -->
            <div class="sponsors-slider-wrap">
                <!-- SPONSORS SLIDER CONTROLS -->
                <div id="footer-sponsor-slider-controls" class="sponsors-slider-controls">
                    <div class="sponsors-slider-control control-previous">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                    <div class="sponsors-slider-control control-next">
                        <!-- ARROW ICON -->
                        <svg class="arrow-icon medium">
                            <use xlink:href="#svg-arrow-medium"></use>
                        </svg>
                        <!-- /ARROW ICON -->
                    </div>
                </div>
                <!-- /SPONSORS SLIDER CONTROLS -->

                <!-- SPONSORS SLIDER -->
                <div id="footer-sponsor-slider" class="sponsors-slider">
                    <!-- SPONSORS SLIDER ITEMS -->
                    <div class="sponsors-slider-items">
                        <!-- SPONSORS SLIDER ITEM -->
                        <div class="sponsors-slider-item">
                            <img class="sponsor-img" src="{{ asset('assets/img/sponsors/sponsor01.png') }}" alt="sponsor01">
                        </div>
                        <!-- /SPONSORS SLIDER ITEM -->

                        <!-- SPONSORS SLIDER ITEM -->
                        <div class="sponsors-slider-item">
                            <img class="sponsor-img" src="{{ asset('assets/img/sponsors/sponsor02.png') }}" alt="sponsor02">
                        </div>
                        <!-- /SPONSORS SLIDER ITEM -->

                        <!-- SPONSORS SLIDER ITEM -->
                        <div class="sponsors-slider-item">
                            <img class="sponsor-img" src="{{ asset('assets/img/sponsors/sponsor03.png') }}" alt="sponsor03">
                        </div>
                        <!-- /SPONSORS SLIDER ITEM -->

                        <!-- SPONSORS SLIDER ITEM -->
                        <div class="sponsors-slider-item">
                            <img class="sponsor-img" src="{{ asset('assets/img/sponsors/sponsor04.png') }}" alt="sponsor04">
                        </div>
                        <!-- /SPONSORS SLIDER ITEM -->

                        <!-- SPONSORS SLIDER ITEM -->
                        <div class="sponsors-slider-item">
                            <img class="sponsor-img" src="{{ asset('assets/img/sponsors/sponsor05.png') }}" alt="sponsor05">
                        </div>
                        <!-- /SPONSORS SLIDER ITEM -->

                        <!-- SPONSORS SLIDER ITEM -->
                        <div class="sponsors-slider-item">
                            <img class="sponsor-img" src="{{ asset('assets/img/sponsors/sponsor06.png') }}" alt="sponsor06">
                        </div>
                        <!-- /SPONSORS SLIDER ITEM -->
                    </div>
                    <!-- /SPONSORS SLIDER ITEMS -->
                </div>
                <!-- /SPONSORS SLIDER -->
            </div>
            <!-- /SPONSORS SLIDER WRAP -->

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

                <!-- BUBBLE ORNAMENT -->
                <a href="#" class="bubble-ornament insta">
                    <!-- INSTAGRAM ICON -->
                    <svg class="instagram-icon">
                        <use xlink:href="#svg-instagram"></use>
                    </svg>
                    <!-- /INSTAGRAM ICON -->
                </a>
                <!-- /BUBBLE ORNAMENT -->

                <!-- BUBBLE ORNAMENT -->
                <a href="#" class="bubble-ornament twitch">
                    <!-- TWITCH ICON -->
                    <svg class="twitch-icon">
                        <use xlink:href="#svg-twitch"></use>
                    </svg>
                    <!-- /TWITCH ICON -->
                </a>
                <!-- /BUBBLE ORNAMENT -->
            </div>
            <!-- /SOCIAL LINKS -->
        </div>
        <!-- /FOOTER TOP BRAND -->

        <!-- LINE SEPARATOR -->
        <div class="line-separator negative"></div>

        <!-- FOOTER TOP WIDGETS -->
        <div class="footer-top-widgets grid-4col centered gutter-big">

            <!-- FOOTER TOP WIDGET -->
            <div class="footer-top-widget">
                <!-- SECTION TITLE WRAP -->
                <div class="section-title-wrap green negative">
                    <h2 class="section-title">Contact Info</h2>
                    <div class="section-title-separator"></div>
                </div>
                <!-- /SECTION TITLE WRAP -->

                <!-- CONTACT INFO PREVIEW -->
                <div class="contact-info-preview negative">
                    <p class="contact-info-preview-text">Lorem ipsum dolor sit amet, consectetur dasede do eiusmod <span class="highlighted">tempor</span> unt ut labore et dolore mag lere adveniam, quis rud citation laboris.</p>
                    <!-- CONTACT INFO PREVIEW SIGN -->
                    <div class="contact-info-preview-sign">
                        <!-- BUBBLE ORNAMENT -->
                        <div class="bubble-ornament medium green">
                            <i class="icon-bubbles bubbles-icon"></i>
                        </div>
                        <!-- /BUBBLE ORNAMENT -->
                        <p class="contact-info-preview-sign-text">Subscribe to our newsletter!</p>
                    </div>
                    <!-- CONTACT INFO PREVIEW SIGN -->

                    <!-- CONTACT INFO PREVIEW FORM -->
                    <form method="GET" class="contact-info-preview-form">
                        <!-- FORM ROW -->
                        <div class="form-row">
                            <!-- FORM ITEM -->
                            <div class="form-item">
                                <!-- SUBMIT INPUT -->
                                <div class="submit-input green">
                                    <input type="text" id="footer-subscribe-email" name="footer-subscribe-email" placeholder="Enter your email here...">
                                    <button class="submit-input-button">
                                        <!-- ARROW ICON -->
                                        <svg class="arrow-icon medium">
                                            <use xlink:href="#svg-arrow-medium"></use>
                                        </svg>
                                        <!-- /ARROW ICON -->
                                    </button>
                                </div>
                                <!-- /SUBMIT INPUT -->
                            </div>
                            <!-- /FORM ITEM -->
                        </div>
                        <!-- /FORM ROW -->
                    </form>
                    <!-- /CONTACT INFO PREVIEW FORM -->

                    <!-- CONTACT INFO PREVIEW EMAIL WRAP -->
                    <div class="contact-info-preview-email-wrap">
                        <i class="email-icon icon-envelope"></i>
                        <a href="mailto:{{ $configurations['website_mail'] ?? '' }}" class="contact-info-preview-email">{{ $configurations['website_mail'] ?? '' }}</a>
                    </div>
                    <!-- CONTACT INFO PREVIEW EMAIL WRAP -->
                </div>
                <!-- /CONTACT INFO PREVIEW -->
            </div>
            <!-- FOOTER TOP WIDGET -->

            <!-- FOOTER TOP WIDGET -->
            <div class="footer-top-widget">
                <!-- SECTION TITLE WRAP -->
                <div class="section-title-wrap red negative">
                    <h2 class="section-title">Latest Reviews</h2>
                    <div class="section-title-separator"></div>
                </div>
                <!-- /SECTION TITLE WRAP -->

                <!-- POST PREVIEW SHOWCASE -->
                <div class="post-preview-showcase grid-1col gutter-small">
                    <!-- POST PREVIEW -->
                    @foreach (App\Helpers\CommonHelper::getLatestNews(null) as $latestNews)
                    <div class="post-preview tiny negative game-review">
                        <!-- POST PREVIEW IMG WRAP -->
                        <a href="{{ route('news.detail', $latestNews['slug']) }}">
                            <div class="post-preview-img-wrap">
                                <!-- POST PREVIEW IMG -->
                                <figure class="post-preview-img liquid">
                                    <img src="{{ $latestNews['image'] }}" alt="post-16">
                                </figure>
                                <!-- /POST PREVIEW IMG -->
                            </div>
                        </a>
                        <!-- /POST PREVIEW IMG WRAP -->

                        <!-- POST PREVIEW TITLE -->
                        <a href="{{ route('news.detail', $latestNews['slug']) }}" class="post-preview-title">{{ $latestNews['name'] }}</a>
                        <!-- POST AUTHOR INFO -->
                        <div class="post-author-info-wrap">
                            <p class="post-author-info small light">By <a href="#" class="post-author">{{ $latestNews['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($latestNews['created_at'])) }}</p>
                        </div>
                        <!-- /POST AUTHOR INFO -->
                    </div>
                    @endforeach
                    <!-- /POST PREVIEW -->
                </div>
                <!-- /POST PREVIEW SHOWCASE -->
            </div>
            <!-- FOOTER TOP WIDGET -->

            <!-- FOOTER TOP WIDGET -->
            <div class="footer-top-widget">
                <!-- SECTION TITLE WRAP -->
                <div class="section-title-wrap blue negative">
                    <h2 class="section-title">Latest Posts</h2>
                    <div class="section-title-separator"></div>
                </div>
                <!-- /SECTION TITLE WRAP -->

                <!-- POST PREVIEW SHOWCASE -->
                <div class="post-preview-showcase grid-1col gutter-small">
                    <!-- POST PREVIEW -->
                    <div class="post-preview tiny negative gaming-news">
                        <!-- POST PREVIEW IMG WRAP -->
                        <a href="post-v1.html">
                            <div class="post-preview-img-wrap">
                                <!-- POST PREVIEW IMG -->
                                <figure class="post-preview-img liquid">
                                    <img src="{{ asset('assets/img/posts/17.jpg') }}" alt="post-17">
                                </figure>
                                <!-- /POST PREVIEW IMG -->
                            </div>
                        </a>
                        <!-- /POST PREVIEW IMG WRAP -->

                        <!-- POST PREVIEW TITLE -->
                        <a href="post-v1.html" class="post-preview-title">Jazzstar announced that the GTE5 for PC is delayed</a>
                        <!-- POST AUTHOR INFO -->
                        <div class="post-author-info-wrap">
                            <p class="post-author-info small light">By <a href="search-results.html" class="post-author">Dexter</a><span class="separator">|</span>Dec 15th, 2018</p>
                        </div>
                        <!-- /POST AUTHOR INFO -->
                    </div>
                    <!-- /POST PREVIEW -->
                </div>
                <!-- POST PREVIEW SHOWCASE -->
            </div>
            <!-- FOOTER TOP WIDGET -->

            <!-- FOOTER TOP WIDGET -->
            <div class="footer-top-widget">
                <!-- SECTION TITLE WRAP -->
                <div class="section-title-wrap blue negative">
                    <h2 class="section-title">Popular Posts</h2>
                    <div class="section-title-separator"></div>
                </div>
                <!-- /SECTION TITLE WRAP -->

                <!-- POST PREVIEW SHOWCASE -->
                <div class="post-preview-showcase grid-1col gutter-small">
                    <!-- POST PREVIEW -->
                    @foreach (App\Helpers\CommonHelper::getPopularNews(null) as $popularNews)
                    <div class="post-preview tiny negative game-review">
                        <!-- POST PREVIEW IMG WRAP -->
                        <a href="{{ route('news.detail', $popularNews['slug']) }}">
                            <div class="post-preview-img-wrap">
                                <!-- POST PREVIEW IMG -->
                                <figure class="post-preview-img liquid">
                                    <img src="{{ $popularNews['image'] }}" alt="post-16">
                                </figure>
                                <!-- /POST PREVIEW IMG -->
                            </div>
                        </a>
                        <!-- /POST PREVIEW IMG WRAP -->

                        <!-- POST PREVIEW TITLE -->
                        <a href="{{ route('news.detail', $popularNews['slug']) }}" class="post-preview-title">{{ $popularNews['name'] }}</a>
                        <!-- POST AUTHOR INFO -->
                        <div class="post-author-info-wrap">
                            <p class="post-author-info small light">By <a href="#" class="post-author">{{ $popularNews['user']->name }}</a><span class="separator">|</span>{{ date('F jS, Y', strtotime($popularNews['created_at'])) }}</p>
                        </div>
                        <!-- /POST AUTHOR INFO -->
                    </div>
                    @endforeach
                    <!-- /POST PREVIEW -->
                </div>
                <!-- /POST PREVIEW SHOWCASE -->
            </div>
            <!-- FOOTER TOP WIDGET -->
        </div>
        <!-- /FOOTER TOP WIDGETS -->
    </div>
    <!-- /FOOTER TOP -->
</div>
<!-- /FOOTER TOP WRAP -->

<!-- FOOTER BOTTOM WRAP -->
<div class="footer-bottom-wrap">
    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom grid-limit">
        <p class="footer-bottom-text"><span class="brand"><span class="highlighted">{{ $configurations['website_name'] ?? '' }}</span></span><span class="separator">|</span>All Rights Reserved {{ date('Y') }}</p>
        <p class="footer-bottom-text"><a href="#">Terms and Conditions</a><span class="separator">|</span><a href="#">Privacy Policy</a></p>
    </div>
    <!-- /FOOTER BOTTOM -->
</div>
<!-- /FOOTER BOTTOM WRAP -->