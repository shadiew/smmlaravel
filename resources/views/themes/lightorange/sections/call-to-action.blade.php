<!-- learn_more_area_start -->
@if(isset($templates['call-to-action'][0]) && $callToAction = $templates['call-to-action'][0])
    <section class="learn_more_area">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="image_area d-flex justify-content-center ">
                        <img class="img-fluid" src="{{getFile(config('location.content.path').@$callToAction->templateMedia()->image)}}" alt="@lang('call-to-action image')">
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="section_header">
                        <h3>@lang(@$callToAction->description->title)</h3>
                        <h6>@lang(@$callToAction->description->sub_title)</h6>
                    </div>
                    <div class="btn_area">
                        <a href="{{@$callToAction->templateMedia()->button_link}}" class="custom_btn top-right-radius-0">@lang(@$callToAction->description->button_name)</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- learn_more_area_end -->
