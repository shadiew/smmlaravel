<div class="shape3"><img src="{{ asset($themeTrue.'img/shape3.png') }}" alt=""></div>
<!-- about_area_start -->
@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    @if(isset($contentDetails['about-us']))
        @if(0 < count($contentDetails['about-us']))
            <section id="about_area" class="about_area">
                <div class="container">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 d-flex justify-content-center">
                            <div class="image_area">
                                <img class="animation1" src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}">
                                <a data-fancybox data-width="1000" data-height="600"
                                   href="{{@$aboutUs->templateMedia()->youtube_link}}">
                                    <div class="video_play_btn">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="section_content">
                                <div class="section_header">
                                    <div class="section_subtitle">@lang(@$aboutUs->description->title)</div>
                                    <h2>@lang(@$aboutUs->description->sub_title).</h2>
                                    <p>@lang(@$aboutUs->description->short_title)</p>
                                    <p> @lang($aboutUs->description->short_description)</p>
                                </div>
                                <div class="button_area">
                                    <a class="custom_btn top-right-radius-0" href="{{ route('about') }}">@lang('More About')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
@endif
<!-- about_area_end -->
