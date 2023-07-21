@extends('admin.layouts.app')
@section('title')
    @lang('Add Service')
@endsection
@section('content')


    <div class="card card-primary card-form m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body ">
            <form action="{{route('admin.service.store')}}" method="POST" class="form">
                @csrf
                <h5 class="table-group-title text-info mb-2 mb-md-3"><span>@lang('Service Basic')</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('Service Title')</label>
                            <input type="text" name="service_title" value="{{ old('service_title') }}"
                                   placeholder="@lang('Service Title')" class="form-control">
                            @if($errors->has('service_title'))
                                <div class="error text-danger">@lang($errors->first('service_title')) </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Select Category')</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option disabled value="" selected hidden>@lang('Select category')</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id  }}">@lang($categorie->category_title)</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <div class="error text-danger mt-2">@lang($errors->first('category_id')) </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <h5 class="table-group-title text-primary mb-2 mb-md-3"><span>@lang('Price & Status')</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Minimum Amount')</label>
                            <input type="number" class="form-control square" name="min_amount"
                                   value="{{ old('min_amount',500) }}">
                            @if($errors->has('min_amount'))
                                <div class="error text-danger">@lang($errors->first('min_amount')) </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('Rate per 1000')</label>
                            <input type="text" class="form-control square" name="price" placeholder="0.00"
                                   value="{{ old('price') }}">
                            @if($errors->has('price'))
                                <div class="error text-danger">@lang($errors->first('price')) </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Maximum Amount')</label>
                            <input type="number" class="form-control square" name="max_amount"
                                   value="{{ old('max_amount',5000) }}">
                            @if($errors->has('max_amount'))
                                <div class="error text-danger">@lang($errors->first('max_amount')) </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Status')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='service_status'>
                                        <input type="checkbox" name="service_status" class="custom-switch-checkbox"
                                               id="service_status" value="0">
                                        <label class="custom-switch-checkbox-label" for="service_status">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Drip feed')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='drip_feed'>
                                        <input type="checkbox" name="drip_feed" class="custom-switch-checkbox"
                                               id="drip_feed" value="0" checked>
                                        <label class="custom-switch-checkbox-label" for="drip_feed">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <h5 class="table-group-title text-primary mb-2 mb-md-3"><span>@lang('Type & Details')</span></h5>

                <div class="form-group ">
                    <div class="switch-field d-flex">
                        <div class="form-check p-0">
                            <input class="form-check-input" type="radio" name="manual_api" id="less" value="0" {{ old('manual_api', 0) == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="less">
                                @lang('Manual')
                            </label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input" type="radio" name="manual_api" id="more" value="1" {{ old('manual_api') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="more">
                                @lang('Api')
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row moreField {{ old('manual_api', 0) == 0 ? 'd-none' : ''  }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label " for="apiprovider">@lang('API Provider Name')</label>
                            <select class="form-control" name="api_provider_id">
                                <option value="0" hidden>@lang('Select API Provider name')</option>
                                @foreach($apiProviders as $apiProvider)
                                    <option value="{{ $apiProvider->id }}" {{ old('api_provider_id') == $apiProvider->id ? 'selected' : '' }}>{{ $apiProvider->api_name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('api_provider_id'))
                                <div class="error text-danger">@lang($errors->first('api_provider_id')) </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('API Service ID')</label>
                            <input type="text" class="form-control square" name="api_service_id"
                                   value="{{ old('api_service_id') }}" placeholder="@lang('Api Service ID')">
                            @if($errors->has('api_service_id'))
                                <div class="error text-danger">@lang($errors->first('api_service_id')) </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>@lang('Select Refill')</label>
                    <select class="form-control" name="refill" id="refill">
                        <option disabled value="" selected hidden>@lang('Select Refill')</option>
                        <option value="1" {{(old('refill') == '1') ? 'selected':''}} >@lang('Manual')</option>
                        <option value="2" {{(old('refill') == '2') ? 'selected':''}} class="automatic">@lang('Automatic')</option>
                        <option value="3" {{(old('refill') == '3') ? 'selected':''}}>@lang('Off')</option>
                    </select>
                    @if($errors->has('refill'))
                        <div class="error text-danger">@lang($errors->first('refill')) </div>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <label class="control-label " for="fieldone">@lang('Description')</label>
                    <textarea class="form-control" rows="4" placeholder="@lang('Description') " name="description"></textarea>
                    @if($errors->has('description'))
                        <div class="error text-danger">@lang($errors->first('description')) </div>
                    @endif
                </div>
                <div class="submit-btn-wrapper mt-md-3  text-center text-md-left">
                    <button type="submit" class="btn  btn-primary btn-block mt-3">
                        <span><i class="fas fa-save pr-2"></i> @lang('Save Changes')</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('js')
    <script>
            "use strict";

            var $serviceType = '';

            $serviceType = $('input[name=manual_api]:checked').val();

            checkType($serviceType);

            $(document).on('click', '#more', function () {
                $(".moreField").removeClass('d-none');

            });
            $(document).on('click', '#less', function () {
                $(".moreField").addClass('d-none');
            });

            $(document).on('click',"input[name=manual_api]:checked", function () {
               $serviceType = $(this).val();
               checkType($serviceType);
            });

            function checkType(serviceType){
                if(serviceType == 0){
                    $('select[name=refill]').val('')
                    $(".automatic").addClass('d-none');
                    return 0;
                }else{
                    $('select[name=refill]').val('')
                    $(".automatic").removeClass('d-none');
                    return 0;
                }

            }

            $(document).ready(function () {
                $('#category_id').select2({
                    selectOnClose: true
                });
            });
    </script>



@endpush
