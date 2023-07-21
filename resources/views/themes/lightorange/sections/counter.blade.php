<!-- achivement_area_start -->
@if(isset($contentDetails['counter']))
    @if(0 < count($contentDetails['counter']))
        <section class="achivement_area">
            <div class="container">
                <div class="row align-items-center g-5">
                    @if(isset($templates['counter'][0]) && $counter = $templates['counter'][0])
                        <div class="col-lg-6">
                            <div class="section_header mb-0 text-center text-lg-start">
                                <h3 class="mb-0">@lang(@$counter->description->title)</h3>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="row">
                            @foreach($contentDetails['counter'] as $data)
                                <div class="col-md-6">
                                    <div class="cmn_box text-center">
                                        <div class="image_area">
                                            <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}"
                                                 alt="@lang('counter image')">
                                        </div>
                                        <div class="text_area">
                                            <h4><span class="achivement_counter">{{ trim(@$data->description->number_of_data) }}</span> +</h4>
                                            <h5>@lang(@$data->description->title)</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
<!-- achivement_area_end -->
