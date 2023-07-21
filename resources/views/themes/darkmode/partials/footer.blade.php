<!-- FOOTER -->
@if( isset($templates['contact-us'][0])  && $contactUs = $templates['contact-us'][0])
    <footer class="footer-section">
        <div class="overlay">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="box box1">
                            <a class="navbar-brand" href="index.html">
                                    <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="@lang('Logo')">
                            </a>
                            <p>@lang(@$contactUs->description->footer_short_details)</p>

                            @if(isset($contentDetails['social']))
                                <div class="social-links">
                                    @foreach($contentDetails['social'] as $data)
                                    <a href="{{@$data->content->contentMedia->description->link}}" target="_blank">
                                        <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                                    </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 ps-lg-5">
                        <div class="box">
                            <h5>{{trans('Quick Links')}}</h5>
                            <ul class="links">
                                <li><a href="{{route('home')}}">@lang('Home')</a></li>
                                <li><a href="{{route('about')}}">@lang('About Us')</a></li>
                                <li><a href="{{route('blog')}}">@lang('Blog')</a></li>
                                <li><a href="{{route('faq')}}">@lang('FAQ')</a></li>
                                <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="box">
                        <h5>{{trans('Support')}}</h5>
                        <ul class="links">
                            <li><a href="{{route('apiDocs')}}">@lang('API DOCS')</a></li>
                            @isset($contentDetails['support'])
                                @foreach($contentDetails['support'] as $data)
                                    <li><a href="{{route('getLink', [slug($data->description->title), $data->content_id])}}">@lang($data->description->title)</a></li>
                                @endforeach
                            @endisset
                        </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="box">
                        <h5>@lang('subscribe newsletter')</h5>
                        <form action="{{route('subscribe')}}" method="post">
                            <div class="input-group">
                                @csrf
                                <input class="form-control" name="email" type="email" placeholder="{{trans('Enter email')}}">
                                <button type="sumit"><i class="fal fa-paper-plane"></i></button>

                            </div>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </form>
                        </div>
                    </div>
                </div>
                <div class="d-flex copyright justify-content-between">
                    <div>
                        <span>
                            @lang('All rights reserved') © {{date('Y')}} @lang('by')<a href="javascript:void(0)">{{trans(config('basic.site_title'))}}</a>
                        </span>
                    </div>
                    <div>
                        @foreach($languages as $language)
                            <a href="{{route('language',[$language->short_name])}}" class="language">
                                {{$language->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- /FOOTER -->
@endif
