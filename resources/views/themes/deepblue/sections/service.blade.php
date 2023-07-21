@if(isset($contentDetails['service']))
    @if(0 < count($contentDetails['service']))
    <!-- SERVICES -->
    <section class="service-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if(isset($templates['service'][0]) && $service = $templates['service'][0])
                        <div class="header-text mb-5 text-center">
                            <h5>@lang(@$service->description->title)</h5>
                            <h3>@lang(@$service->description->sub_title)</h3>
                            <p>@lang(@$service->description->short_title)</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                @foreach($contentDetails['service'] as $data)
                    <div class="col-lg-4">
                        <div
                            class="service-box"
                            data-aos="fade-up"
                            data-aos-duration="1200"
                            data-aos-anchor-placement="center-bottom"
                        >
                            <div class="icon-box">
                                <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('service image')" />
                            </div>
                            <h4>@lang(@$data->description->title)</h4>
                            <p>@lang(@$data->description->short_description)</p>
                            <a href="{{@$data->content->contentMedia->description->button_link}}" class="read-more">@lang(@$data->description->button_name)</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
     </section>
    <!-- /SERVICES -->
    @endif
@endif
