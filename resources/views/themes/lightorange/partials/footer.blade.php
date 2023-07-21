@if( isset($templates['contact-us'][0])  && $contactUs = $templates['contact-us'][0])
    <section class="footer_area">
        <div class="container">
            <div class="row gy-4 gy-sm-5">
                <div class="col-lg-4 col-sm-6">
                    <div class="footer_widget">
                        <div class="widget_logo">
                            <h5><a href="{{ route('home') }}" class="site_logo"><img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="@lang('Logo')" class="img-fluid" width="220"></a></h5>
                            <p>@lang(@$contactUs->description->footer_short_details)</p>
                        </div>

                        @if(isset($contentDetails['social']))
                            <div class="social_area mt-50">
                            <ul class="">
                                @foreach($contentDetails['social'] as $data)
                                    <li><a href="{{@$data->content->contentMedia->description->link}}" target="_blank"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer_widget">
                        <h5>@lang('Quick Links')<span class="highlight"> _</span></h5>
                        <ul>
                            <li><a href="{{route('home')}}">@lang('Home')</a></li>
                            <li><a href="{{route('about')}}">@lang('About Us')</a></li>
                            <li><a href="{{route('blog')}}">@lang('Blog')</a></li>
                            <li><a href="{{route('faq')}}">@lang('FAQ')</a></li>
                            <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 pt-sm-0 pt-3 ps-lg-5">
                    <div class="footer_widget">
                        <h5>@lang('Support') <span class="highlight"> _</span></h5>
                        <ul>
                            <li><a href="{{route('apiDocs')}}">@lang('API DOCS')</a></li>

                            @isset($contentDetails['support'])
                                @foreach($contentDetails['support'] as $data)
                                    <li><a href="{{route('getLink', [slug($data->description->title), $data->content_id])}}">@lang($data->description->title)</a></li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 pt-sm-0 pt-3">
                    <div class="footer_widget">
                        <h5>@lang('Language')<span class="highlight"> _</span></h5>
                        <ul>
                            @foreach($languages as $language)
                                <li><a href="{{route('language',[$language->short_name])}}" class="language">{{$language->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer_area_end -->

    <!-- copy_right_area_start -->
    <div class="copy_right_area text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>{{trans('Copyright')}} &copy; {{date('Y')}} {{trans(config('basic.site_title'))}}. {{trans('All Rights Reserved')}}</p>
                </div>

            </div>
        </div>
    </div>
    <!-- copy_right_area_end -->
@endif
