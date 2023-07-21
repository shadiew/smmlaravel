<!-- payment_area_start -->
@if(isset($templates['gateway'][0]) && $gateway = $templates['gateway'][0])
    <section class="payment_area">
    <div class="container">
        <div class="row">
            <div class="section_header text-center mb-50">
                <div class="section_subtitle mx-auto">@lang('PAYMENTS')</div>
                <h2>@lang(@$gateway->description->title)</h2>
            </div>
            <div class="owl-carousel owl-theme payment_slider text-center">
                @foreach($gateways as $gateway)
                    <div class="item">
                    <div class="image_area">
                        <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}" alt="{{@$gateway->name}}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- payment_area_end -->

