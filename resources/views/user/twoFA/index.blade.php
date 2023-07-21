@extends('user.layouts.app')
@section('title',trans('2 Step Security'))

@section('content')


<div class="container">
    <ol class="breadcrumb center-items">
        <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
        <li class="active">@lang('2 Step Security')</li>
    </ol>

    <div class="row twoStepSecurity my-3">

        @if(auth()->user()->two_fa)
            <div class="col-lg-6 col-md-6 mb-3">
                <div class="card card-type-1 text-center shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title py-3 mb-4 greenColorText font-weight-bold">@lang('Two Factor Authenticator')</h2>
                        <div class="form-group form-block">
                            <div class="input-group">
                                <input type="text" value="{{$previousCode}}"
                                       class="form-control form-control-lg bg-transparent" id="referralURL"
                                       readonly>
                                <div class="input-group-append" title="Copy">
                                    <span class="input-group-text copytext" id="copyBoard"
                                          onclick="copyFunction()">
                                        <i class="fa fa-copy"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mx-auto text-center">
                            <img class="mx-auto" src="{{$previousQR}}">
                        </div>

                        <div class="form-group mx-auto text-center">
                            <a href="javascript:void(0)" class="btn btn-block btn-lg btn-danger"
                               data-toggle="modal" data-target="#disableModal">@lang('Disable Two Factor Authenticator')</a>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="col-lg-6 col-md-6 mb-3">
                <div class="card card-type-1 text-center box-shadow">
                    <div class="card-body">
                        <h2 class="card-title py-3 mb-4 greenColorText font-weight-bold">@lang('Two Factor Authenticator')</h2>

                        <div class="form-group ">
                            <div class="input-group">
                                <input type="text" value="{{$secret}}"
                                       class="form-control form-control-lg bg-transparent" id="referralURL"
                                       readonly>
                                <div class="input-group-append" title="copy">
                                        <span class="input-group-text copytext" id="copyBoard"
                                              onclick="copyFunction()">
                                            <i class="fa fa-copy"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mx-auto text-center">
                            <img class="mx-auto" src="{{$qrCodeUrl}}">
                        </div>

                        <div class="form-group mx-auto text-center">
                            <a href="javascript:void(0)" class="btn btn-block btn-lg btn-success"
                               data-toggle="modal"
                               data-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                        </div>
                    </div>

                </div>
            </div>

        @endif


        <div class="col-lg-6 col-md-6 mb-3">
            <div class="card card-type-1 text-center box-shadow">
                <div class="card-body">
                    <h2 class="card-title py-3 mb-4 greenColorText font-weight-bold">@lang('Google Authenticator')</h2>
                    <h6 class="text-uppercase my-3 font16">@lang('Use Google Authenticator to Scan the QR code  or use the code')</h6>

                    <p class="p-5 font14">@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')</p>
                    <a class="btn btn-success btn-md mt-3"
                       href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                       target="_blank">@lang('DOWNLOAD APP')</a>

                </div>

            </div>
        </div>

    </div>
</div>

    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content form-block">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Verify Your OTP')</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.twoStepEnable')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control bg-transparent" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Verify')</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content form-block">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Verify Your OTP to Disable')</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.twoStepDisable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control bg-transparent" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Verify')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection



@push('js')
    <script>
        function copyFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>
@endpush

