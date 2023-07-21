<div class="shape2"><img src="{{ asset($themeTrue.'img/shape2.png') }}" alt=""></div>

<!-- service_area_start -->
@if(isset($contentDetails['service']))
    @if(0 < count($contentDetails['service']))
        <section class="service_area">
    <div class="container">
        <div class="row">
            @if(isset($templates['service'][0]) && $service = $templates['service'][0])
                <div class="section_header text-center">
                <div class="section_subtitle">@lang(@$service->description->title)</div>
                <h2>@lang(@$service->description->sub_title)</h2>
                <p class="para_text m-auto">@lang(@$service->description->short_title)</p>
            </div>
            @endif
        </div>
        <div class="row g-5 justify-content-center position-relative">
            <img class="shape1" src="{{ asset($themeTrue.'img/shape1.png') }}" alt="">
            @foreach($contentDetails['service'] as $data)
                <div class="col-lg-4 col-md-6 mb-5">
                <div class="cmn_box box1 text-center shadow3">
                    <div class="cmn_icon icon1">
                        <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('service image')">
                    </div>
                    <h5 class="pt-30 mb-20">@lang(@$data->description->title)</h5>
                    <p>@lang(@$data->description->short_description)</p>
                    <a href="{{@$data->content->contentMedia->description->button_link}}" class="custom_btn mt-30 top-right-radius-0">@lang(@$data->description->button_name)</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
    @endif
@endif
<!-- service_area_end -->
