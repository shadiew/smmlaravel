@extends($theme.'layouts.app')
@section('title','404')


@section('content')
    <!-- ERROR -->
    <section class="not-found">
        <div class="container h-100">
           <div class="row h-100 justify-content-center">
              <div class="col-md-6">
                 <div class="text-box text-center">
                    <img src="{{ asset($themeTrue.'img/error-404.png')}}" alt="@lang('404 image')" class="img_404"/>
                    <h1>@lang('Opps!')</h1>
                    <h4>@lang("Sorry page was not found!")</h4>
                    <p>@lang("We're sorry, the page you requested could not be found. Please go back to the homepage or contact us at") {{config('basic.sender_email')}}</p>
                    <a class="btn back_404" href="{{url('/')}}">@lang('Back To Home')</a>
                 </div>
              </div>
           </div>
        </div>
     </section>

    <!-- /ERROR -->
@endsection
