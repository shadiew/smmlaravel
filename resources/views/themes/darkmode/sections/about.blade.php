@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    @if(isset($contentDetails['about-us']))
        @if(0 < count($contentDetails['about-us']))
            <!-- ABOUT-US -->
            <section class="about-section">
                <div class="container">
                    <div class="row align-items-center gy-5 g-lg-4">
                        <div class="col-lg-6">
                            <div
                                class="img-box"
                                data-aos="fade-right"
                                data-aos-duration="800"
                                data-aos-anchor-placement="center-bottom"
                            >
                                <img class="img-fluid" src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" alt="@lang('about image')" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-box">
                                <div class="header-text">
                                    <h5 class="title">@lang($aboutUs->description->title)</h5>
                                    <h3>@lang($aboutUs->description->short_title)</h3>
                                </div>
                                    @foreach($contentDetails['about-us'] as $about)
                                        <div
                                            class="info-box"
                                            data-aos="fade-left"
                                            data-aos-duration="800"
                                            data-aos-anchor-placement="center-bottom"
                                        >
                                        <div class="icon-box">
                                            <img src="{{getFile(config('location.content.path').@$about->content->contentMedia->description->image)}}" alt="@lang('about image')" />
                                        </div>
                                        <div class="text">
                                            <h5>@lang($about->description->title)</h5>
                                            <p>@lang($about->description->short_description)</p>
                                        </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- /ABOUT-US -->

        @endif
    @endif
@endif
