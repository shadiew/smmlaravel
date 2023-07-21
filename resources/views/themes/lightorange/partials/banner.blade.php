<style>
    .banner_area {
        background: linear-gradient(180deg, {{hex2rgba(config('color.secondary_color'),0.99)}},{{hex2rgba(config('color.theme_light_color'),0.8)}}), url({{asset($themeTrue.'img/partial_banner.jpg')}});
        padding: 180px 0 75px 0;
        position: relative;
        background-size: cover;
    }
</style>


<!-- banner_area_start -->
<div class="banner_area">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 ">
                <div class="breadcrumb_area">
                    <h6>@yield('title')</h6>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner_area_end -->

