<!-- FAQ -->
@if(isset($contentDetails['faq']))
    @if(0 < count($contentDetails['faq']))
        <section class="faq-section faq-page">
            <div class="container">
            <div class="row g-4 gy-5 justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        @foreach($contentDetails['faq'] as $k => $data)
                            <div class="accordion-item">
                                <h5 class="accordion-header" id="heading{{$k}}">
                                    <button
                                        class="accordion-button {{ $k == 0 ? '' : 'collapsed' }}"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$k}}"
                                        aria-expanded="true"
                                        aria-controls="collapse{{$k}}"
                                    >
                                        @lang(@$data->description->title)
                                    </button>
                                </h5>
                                <div
                                    id="collapse{{$k}}"
                                    class="accordion-collapse collapse {{ $k == 0 ? 'show' : '' }}"
                                    aria-labelledby="heading{{$k}}"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        @lang(@$data->description->description)
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
<!-- /FAQ -->
