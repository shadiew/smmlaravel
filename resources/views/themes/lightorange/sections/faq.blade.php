<!-- faq_page_start -->
@if(isset($contentDetails['faq']))
    @if(0 < count($contentDetails['faq']))
        <section class="faq_area">
            <div class="container">
                <div class="row">
                    @if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
                        <div class="section_header text-center text-sm-start">
                            <h2>@lang(@$faq->description->title)</h2>
                            <p class="para_text">@lang(@$faq->description->short_details)</p>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-10 col-12">
                        <div class="accordion" id="accordionExample">
                            @foreach($contentDetails['faq'] as $k => $data)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$k}}">
                                        <button class="accordion-button {{ $k == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{$k}}"
                                                aria-expanded="true" aria-controls="collapse{{$k}}">
                                            @lang(@$data->description->title)
                                        </button>
                                    </h2>
                                    <div id="collapse{{$k}}" class="accordion-collapse collapse {{ $k == 0 ? 'show' : '' }}"
                                         aria-labelledby="heading{{$k}}"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                @lang(@$data->description->description)
                                            </div>
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
<!-- faq_page_end -->



