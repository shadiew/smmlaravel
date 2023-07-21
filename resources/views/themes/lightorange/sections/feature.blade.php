<!-- Feature_area_start -->
@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
        <section class="feature_area mt-5 mt-md-0 ">
            <div class="container">
                <div class="row g-lg-5 justify-content-center position-relative">
                    <img class="shape1" src="{{ asset($themeTrue.'img/shape1.png') }}" alt="">
                    @foreach($contentDetails['feature'] as $feature)
                        <div class="col-lg-4 col-md-6 mb-5">
                        <div class="cmn_box box1 text-center shadow3">
                            <div class="cmn_icon icon1">
                                <img src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="@lang('feature icon')">
                            </div>
                            <h5 class="pt-30 mb-20">@lang(@$feature->description->title)</h5>
                            <p>@lang(@$feature->description->short_description)</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
<!-- Feature_area_end -->
