@if(isset($contentDetails['how-it-work']))
    @if(0 < count($contentDetails['how-it-work']))
        <!-- HOW-IT-WORKS -->
        <section class="how-it-works">
            <div class="container">
                <div class="row align-items-center gy-5 g-lg-4">
                    <div class="col-lg-6">
                        @if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
                            <div class="text-box">
                                <div class="header-text">
                                    <h5 class="title">@lang(@$howItWork->description->sub_title)</h5>
                                    <h3>@lang(@$howItWork->description->short_title)</h3>
                                    <p>@lang(@$howItWork->description->short_description)</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <div class="work-box-wrapper">
                            <div class="shape"></div>
                            <div class="row g-4">
                                @foreach($contentDetails['how-it-work'] as $data)
                                    <div class="col-md-6">
                                        <div
                                            class="work-box"
                                            data-aos="fade-up"
                                            data-aos-duration="800"
                                            data-aos-anchor-placement="center-bottom"
                                        >
                                            <div class="icon-box">
                                                <i class="{{ @$data->content->contentMedia->description->icon }}"></i>
                                            </div>
                                            <h5>@lang(@$data->description->title)</h5>
                                            <p>@lang(@$data->description->short_description)</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /HOW-IT-WORKS -->
    @endif
@endif
