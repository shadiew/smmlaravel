@if(isset($contentDetails['counter']))
    @if(0 < count($contentDetails['counter']))
        <!-- COUNTER -->
        <section class="achievement-section">
            <div class="container">
            <div class="row justify-content-center">
                @if(isset($templates['counter'][0]) && $counter = $templates['counter'][0])
                    <div class="col-12 w-64">
                        <h3>@lang($counter->description->title)</h3>
                    </div>
                @endif
            </div>

            <div class="row gy-5 g-lg-4">
                @foreach($contentDetails['counter'] as $data)
                    <div class="col-lg-3 col-md-6">
                        <div
                            class="counter-box"
                            data-aos="fade-up"
                            data-aos-duration="800"
                            data-aos-anchor-placement="center-bottom"
                        >
                            <div class="icon-box">
                                <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('counter image')" />
                            </div>
                            <h4><span class="counter">{{ trim(@$data->description->number_of_data) }}</span> +</h4>
                            <p class="text-capitalize">@lang(@$data->description->title)</p>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </section>
        <!-- /COUNTER -->
    @endif
@endif
