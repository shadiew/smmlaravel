@extends($theme.'layouts.app')
@section('title','500')


@section('content')
    <section class="not-found">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-md-6">
                    <div class="text-box text-center">
                        <h1>@lang('Opps!')</h1>
                        <p>@lang("The server encountered an internal error misconfiguration and was unable to complate your request. Please contact the server administrator.")</p>
                        <a class="btn" href="{{url('/')}}">@lang('Back To Home')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ERROR -->
@endsection
