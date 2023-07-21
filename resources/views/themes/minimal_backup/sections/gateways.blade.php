<!-- WORK-WITH -->
@if(isset($templates['gateway'][0]) && $gateway = $templates['gateway'][0])
    <section id="work-with">
        <div class="container">
            <div class="heading-container">
                <h3 class="slogan">@lang($gateway->description->title)</h3>
            </div>

            <div class="workwith justify-content-start">
                @foreach($gateways as $gateway)
                    <img src="{{getFile(config('location.gateway.path').$gateway->image)}}" class="m-2" alt="{{$gateway->name}}">
                @endforeach
            </div>
        </div>
    </section>
@endif
<!-- /WORK-WITH -->
