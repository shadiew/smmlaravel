@if(isset($templates['gateway'][0]) && $gateway = $templates['gateway'][0])
    <section class="payment-gateway">
        <div class="container">
        <div class="row">
            <div class="col">
                <div class="header-text text-center">
                    <h3>@lang($gateway->description->title)</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="gateways owl-carousel">
                    @foreach($gateways as $gateway)
                        <img src="{{getFile(config('location.gateway.path').$gateway->image)}}" alt="{{$gateway->name}}"/>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
@endif
