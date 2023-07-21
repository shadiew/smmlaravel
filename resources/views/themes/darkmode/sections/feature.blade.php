@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
        <!-- FEATURE -->
        <section class="feature-section">
            <div class="container">
                <div class="row gy-5 g-lg-4">
                    @foreach($contentDetails['feature'] as $feature)
                        <div class="col-lg-4">
                            <div
                                class="feature-box"
                                data-aos="fade-up"
                                data-aos-duration="800"
                                data-aos-anchor-placement="center-bottom"
                            >
                                <div class="icon-box">
                                    <img src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="@lang('feature icon')" />
                                </div>
                                <h4>@lang($feature->description->title)</h4>
                                <p>@lang($feature->description->short_description)</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section> <!-- /FEATURE -->
    @endif
@endif
