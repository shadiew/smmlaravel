<div class="shape3"><img src="{{ asset($themeTrue.'img/shape3.png') }}" alt="@lang('not found')"></div>

<!-- how_it_work_area_start -->
@if(isset($contentDetails['how-it-work']))
    @if(0 < count($contentDetails['how-it-work']))
        <section class="how_it_work_area">
            <div class="container">
                <div class="row">
                    @if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
                        <div class="section_header mb-50 text-center">
                            <div class="section_subtitle">@lang(@$howItWork->description->sub_title)</div>
                            <h2>@lang(@$howItWork->description->short_title)</h2>
                            <p class="para_text m-auto">@lang(@$howItWork->description->short_description)</p>
                        </div>
                    @endif
                </div>
                <div class="row align-items-center">
                    @foreach($contentDetails['how-it-work'] as $key =>  $data)
                        <div class="col-md-6">
                            <div class="cmn_box2 box1 d-flex shadow3 flex-column flex-sm-row">
                                <span class="number">{{ ++$key }}</span>
                                <div class="image_area ">
                                    <i class="{{ @$data->content->contentMedia->description->icon }}"></i>
                                </div>
                                <div class="text_area">
                                    <h5>@lang(@$data->description->title)</h5>
                                    <p>@lang(@$data->description->short_description)</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
<!-- how_it_work_area_end -->
