<div class="shape3"><img src="{{ asset($themeTrue.'img/shape3.png') }}"></div>

<!-- testimonial_area_start -->
@if(isset($contentDetails['testimonial']))
    @if(0 < count($contentDetails['testimonial']))
        <section class="testimonial_area">
    <div class="container">
        <div class="row">
            @if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
                <div class="section_header mb-50 text-center">
                    <div class="section_subtitle">@lang(@$testimonial->description->title)</div>
                    <h2 class="">@lang(@$testimonial->description->short_title)</h2>
                    <p class="para_text m-auto">@lang(@$testimonial->description->short_description)</p>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="owl-carousel owl-theme testimonial_carousel">
                @foreach($contentDetails['testimonial'] as $key => $data)
                    <div class="item">
                    <div class="cmn_box box1 custom_zindex shadow2">
                        <div class="cmn_icon icon1">
                            <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}"
                                 alt="@lang('client image')" class="img-fluid">
                        </div>
                        <div class="text_area text-center ">
                            <h4 class="mt-20">@lang(@$data->description->name)</h4>
                            <h6>@lang(@$data->description->designation)</h6>
                            <div class="quote_area"><img src="{{ asset($themeTrue.'img/quote.png') }}"></div>
                            <p>@lang(@$data->description->description)</p>
                            <div class="quote_area ms-auto"><img src="{{ asset($themeTrue.'img/quote2.png') }}"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</section>
    @endif
@endif
<!-- testimonial_area_end -->

