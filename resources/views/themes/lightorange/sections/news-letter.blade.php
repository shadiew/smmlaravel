<!-- newsletter_area_start -->
<section class="newsletter_area">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8 mx-auto">
                <div class="newsletter_inner top-right-radius-0 bottom-left-radius-0">
                    <h3 class="text-center pb-30"><i class="far fa-paper-plane"></i>@lang('Join our newsletter')</h3>
                    <form class="subscribe-form subscribe_form" action="{{route('subscribe')}}" method="post">
                        @csrf
                        <input type="text" name="email" type="email" placeholder="{{trans('Email Address')}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <button>@lang('SUBSCRIBE')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- newsletter_area_end -->
<!-- newsletter_area_end -->
