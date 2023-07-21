<!DOCTYPE html >
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    @include('partials.seo')

    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'css/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'css/jquery.fancybox.min.css')}}"/>
    @stack('extra-css')
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/style.css') }}"/>
    <script src="{{asset($themeTrue.'js/fontawesomepro.js')}}"></script>

    @stack('style')

    <script src="{{asset('assets/global/js/modernizr.custom.js')}}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body onload="preloder_function()" class="">

<!-- preloader_area_start -->
<div id="preloader">
    <div id="loader"></div>
</div>
<!-- preloader_area_end -->

<!-- Header_area_start -->
    <div class="header_area position-fixed">
    <!-- Nav_area_start -->
    <div class="nav_area">
        <nav class="navbar navbar-expand-lg">
            <div class="container custom_nav">
                <a class="logo" href="{{route('home')}}"><img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="@lang('Logo')"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bars"><i class="fal fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto text-center align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('home')}}" aria-current="page"  href="{{route('home')}}">@lang('Home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('about')}}" href="{{route('about')}}">@lang('About')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('services')}}" href="{{route('services')}}">@lang('Service')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{menuActive('faq')}}" href="{{route('faq')}}">@lang('FAQ')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('blog')}}" href="{{route('blog')}}">@lang('Blog')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('contact')}}" href="{{route('contact')}}">@lang('Contact')</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link login_btn top-right-radius-0 {{menuActive('login')}}" href="{{route('login')}}">@lang('login')</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link login_btn top-right-radius-0 {{menuActive('login')}}" href="{{route('user.home')}}">@lang('Dashboard')</a>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Nav_area_end -->

</div>
<!-- Header_area_end -->

    @if(\Request::routeIs('home'))
        @stack('banner')
    @else
        @include($theme.'partials.banner')
    @endif

@yield('content')


@stack('extra-content')


@include($theme.'partials.footer')

@include('plugins')

<!-- arrow up -->
<a href="#" class="scroll_up">
    <i class="fal fa-chevron-double-up"></i>
</a>


<script src="{{ asset($themeTrue.'js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset($themeTrue.'js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset($themeTrue.'js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset($themeTrue.'js/owl.carousel.min.js') }}"></script>
<script src="{{ asset($themeTrue.'js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset($themeTrue.'js/jquery.fancybox.min.js') }}"></script>
<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
@stack('extra-js')
<script src="{{ asset($themeTrue.'js/main.js') }}"></script>

@stack('script')
@if (session()->has('success'))
    <script>
        Notiflix.Notify.Success("@lang(session('success'))");
    </script>
@endif

@if (session()->has('error'))
    <script>
        Notiflix.Notify.Failure("@lang(session('error'))");
    </script>
@endif

@if (session()->has('warning'))
    <script>
        Notiflix.Notify.Warning("@lang(session('warning'))");
    </script>
@endif


@if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp
    <script>
        "use strict";
        @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{trans($error)}}");
        @endforeach
    </script>
@endif

<script>
    var root = document.querySelector(':root');
    {{--root.style.setProperty('--theme_color', '{{config('color.theme_color')??'#FA673B'}}');--}}
    {{--root.style.setProperty('--theme_light_color', '{{config('color.theme_light_color')??'#fb6738'}}');--}}
    {{--root.style.setProperty('--secondary_color', '{{config('color.secondary_color')??'#fe5268'}}');--}}
</script>
</body>
</html>
