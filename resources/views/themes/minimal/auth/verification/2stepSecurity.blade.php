@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <section id="contact-us">
        <div class="container">
            <div class="contact-us-form">
                <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-block py-3">
                        <form class="login-form shadow" action="{{route('user.twoFA-Verify')}}"  method="post">
                            @csrf
                            <div class="signin">
                                <h1 class="title greenColor mb-30 text-center">@lang($page_title)</h1>
                                <div class="form-group mb-30">
                                    <input class="form-control" type="text" name="code" value="{{old('code')}}" placeholder="@lang('Code')" autocomplete="off">

                                    @error('code')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                    @error('error')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                </div>

                                <div class="btn-area mb-3">
                                    <button class="send-massage-button anim-button" type="submit"><span>@lang('Submit')</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>


@endsection
