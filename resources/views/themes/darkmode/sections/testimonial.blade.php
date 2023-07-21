@if(isset($contentDetails['testimonial']))
@if(0 < count($contentDetails['testimonial']))
    <!-- TESTIMONIAL -->
    <section class="testimonial-section">
        <div class="container">
        <div class="row">
            @if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
                <div class="col">
                    <div class="header-text mb-5 text-center">
                        <h5>@lang(@$testimonial->description->title)</h5>
                        <h3>@lang(@$testimonial->description->short_title)</h3>
                        <p>@lang(@$testimonial->description->short_description)</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel testimonials">
                    @foreach($contentDetails['testimonial'] as $key => $data)
                        <div class="review-box">
                            <p>@lang(@$data->description->description)</p>
                            <div
                                class="d-flex align-items-end justify-content-between"
                            >
                                <div>
                                    <h5>@lang(@$data->description->name)</h5>
                                    <span class="title">@lang(@$data->description->designation)</span>
                                </div>
                                <div>
                                    <img
                                        class="img-fluid"
                                        src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}"
                                        alt="@lang('client image')"
                                    />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- /TESTIMONIAL -->
@endif
@endif
