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

    <link rel="stylesheet" href="{{asset($themeTrue.'assets/bootstrap/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'assets/plugins/owlcarousel/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'assets/plugins/owlcarousel/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'assets/plugins/owlcarousel/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'assets/plugins/aos/aos.css')}}"/>
    <link rel="stylesheet" href="{{asset($themeTrue.'assets/plugins/fancybox/jquery.fancybox.min.css')}}"/>
    @stack('extra-css')
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/style.css') }}"/>
    @stack('style')

    <script src="{{asset('assets/global/js/modernizr.custom.js')}}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="dark-mode">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="@lang('Logo')">
            </a>
            <button
                class="navbar-toggler p-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fal fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link {{menuActive('home')}}" href="{{route('home')}}">@lang('Home')</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{menuActive('about')}}" href="{{route('about')}}">@lang('About')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{menuActive('services')}}" href="{{route('services')}}">@lang('Services')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{menuActive('faq')}}" href="{{route('faq')}}">@lang('Faq')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{menuActive('blog')}}" href="{{route('blog')}}">@lang('Blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{menuActive('contact')}}" href="{{route('contact')}}">@lang('Contact')</a>
                    </li>

                    @guest
                        <li class="nav-item d-block d-sm-none">
                            <a class="nav-link {{menuActive('login')}}" href="{{route('login')}}">@lang('Login')</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span>@lang('Logout')</span></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
            @guest
                <span class="navbar-text ps-4 d-none d-sm-block">
                    <a href="{{route('login')}}">
                        <button class="btn-smm">@lang('Login')</button>
                    </a>
                </span>
            @else
                <span class="navbar-text ps-4  d-md-block d-none ">
                    <a href="{{route('user.home')}}">
                        <button class="btn-smm">@lang('Dashboard')</button>
                    </a>
                </span>

                <span class="navbar-text ps-4 d-md-none">
                    <a href="{{route('user.home')}}">
                        <button class="btn-smm icon-width"><i class="fa fa-home"></i></button>
                    </a>
                </span>
            @endguest
        </div>
    </nav>

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
<a href="#" class="scroll-up"><i class="fal fa-long-arrow-up"></i> </a>


<script src="{{ asset($themeTrue.'assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/bootstrap/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/plugins/counterup/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/plugins/aos/aos.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset($themeTrue.'assets/fontawesome/fontawesomepro.js') }}"></script>
<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
@stack('extra-js')
<script src="{{ asset($themeTrue.'js/script.js') }}"></script>

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
        "use strict";
        var root = document.querySelector(':root');
        root.style.setProperty('--gold', '{{config('basic.base_color')}}');
    </script>

</body>
</html>
