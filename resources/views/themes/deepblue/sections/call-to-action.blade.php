@if(isset($templates['call-to-action'][0]) && $callToAction = $templates['call-to-action'][0])
    <section class="learn-more">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 pb-5 pb-lg-0">
                <h3>@lang(@$callToAction->description->title)</h3>
                <h5 class="my-4">@lang(@$callToAction->description->sub_title)</h5>
                <a href="{{@$callToAction->templateMedia()->button_link}}" class="btn-smm">
                    @lang(@$callToAction->description->button_name)
                </a>
            </div>
            <div class="col-lg-6">
                <div class="img-box text-center">
                    <img class="img-fluid" src="{{getFile(config('location.content.path').@$callToAction->templateMedia()->image)}}" alt="@lang('call-to-action image')" />
                </div>
            </div>
        </div>
        </div>
    </section>
@endif
