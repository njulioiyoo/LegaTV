@extends('templates.layout')

@section('content')

<!-- BANNER WRAP -->
<!-- BANNER WRAP -->
<div class="banner-wrap geeky-news">
    <!-- BANNER -->
    <div class="banner grid-limit">
      <h2 class="banner-title">Search Results</h2>
      <p class="banner-sections">
        <span class="banner-section">Home</span>
        <!-- ARROW ICON -->
        <svg class="arrow-icon">
          <use xlink:href="#svg-arrow"></use>
        </svg>
        <!-- /ARROW ICON -->
        <span class="banner-section">{{ request()->input('key')   }}</span>
      </p>
    </div>
    <!-- /BANNER -->
  </div>
  <!-- /BANNER WRAP -->

@include('templates.elements.live-news')

<!-- LAYOUT CONTENT FULL -->
<div class="layout-content-full grid-limit">
    <!-- GRID3 1COL -->
    <div class="grid3-1col">
      <!-- WIDGET ITEM -->
      <div class="widget-item">
        <!-- FILTER HEADING -->
        <div class="filter-heading no-border spaced">
          <!-- FILTER HEADING TEXT -->
          <p class="filter-heading-text red"><span class="highlight">{{ count($search) }}</span> Search Results for: "<span class="highlight">{{ request()->input('key') }}</span>"</p>
          <!-- /FILTER HEADING TEXT -->
        </div>
        <!-- /FILTER HEADING -->

        <!-- ACTIVITY ITEMS -->
        @foreach($search as $k => $v)
        @php 
            $date = $v['created_at'];
            // Konversi string menjadi objek DateTime
            $dateObj = new DateTime($date);

            // Hitung selisih waktu antara sekarang dan waktu yang diberikan
            $now = new DateTime();
            $diff = $now->diff($dateObj);

            // Konversi selisih waktu ke dalam format "x waktu yang lalu"
            if ($diff->y > 0) {
                $result = $diff->y . ' years ago';
            } elseif ($diff->m > 0) {
                $result = $diff->m . ' months ago';
            } elseif ($diff->d > 0) {
                $result = $diff->d . ' days ago';
            } elseif ($diff->h > 0) {
                $result = $diff->h . ' hours ago';
            } elseif ($diff->i > 0) {
                $result = $diff->i . ' minutes ago';
            } else {
                $result = 'just now';
            }
        @endphp
        <div class="activity-items">
          <!-- ACTIVITY ITEM -->
          <div class="activity-item">
            <!-- USER AVATAR -->
            <img class="user-avatar" src="{{ $v['image'] }}" alt="user-05">
            <!-- /USER AVATAR -->

            <!-- ACTIVITY ITEM DROPDOWN BUTTON -->
            <div class="activity-item-dropdown-button">
              <!-- ARROW ICON -->
              <svg class="arrow-icon medium">
                <use xlink:href="#svg-arrow-medium"></use>
              </svg>
              <!-- /ARROW ICON -->
            </div>
            <!-- /ACTIVITY ITEM DROPDOWN BUTTON -->

            <!-- ACTIVITY ITEM ROW -->
            <div class="activity-item-row">
              <!-- ACTIVITY ITEM TITLE -->
              <a href="{{ route(''.$v['type'].'.detail', $v['slug']) }}" class="activity-item-title">{{ $v['name'] }}</a>
              <!-- /ACTIVITY ITEM TITLE -->

              <!-- ACTIVITY ITEM TIMESTAMP -->
              <p class="activity-item-timestamp">{{ $result }}</p>
              <!-- /ACTIVITY ITEM TIMESTAMP -->
            </div>
            <!-- /ACTIVITY ITEM ROW -->

            <!-- FORUM CATEGORY TEXT -->
            <a href="#" class="forum-category-text cyan">{{ $v['parent']->name }}</a>
            <!-- /FORUM CATEGORY TEXT -->

            <!-- ACTIVITY ITEM TEXT -->
            <p class="activity-item-text">{!! Str::limit($v['body'], 200) !!}</p>
            <!-- /ACTIVITY ITEM TEXT -->
          </div>
          <!-- /ACTIVITY ITEM -->
        </div>
        @endforeach
        <!-- /ACTIVITY ITEMS -->
      </div>
      <!-- /WIDGET ITEM -->

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
            @for ($i = 1; $i <= $search->lastPage(); $i++)
                <a href="{{ $search->url($i) }}" class="page-navigation-item{{ $search->currentPage() === $i ? ' active' : '' }}">{{ $i }}</a>
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
    <!-- GRID3 1COL -->
  </div>
  <!-- LAYOUT CONTENT FULL -->

@endsection