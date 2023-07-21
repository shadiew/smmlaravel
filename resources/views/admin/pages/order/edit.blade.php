@extends('admin.layouts.app')
@section('title')
    @lang('Edit Order')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <form method="post" action="{{route('admin.order.update', $order->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="category_id">@lang('Category')</label>
                                    <input type="text" class="form-control"
                                           value="{{ optional(optional($order->service)->category)->category_title }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="service_id">@lang('Service')</label>
                                    <input type="text" class="form-control"
                                           value="{{ optional($order->service)->service_title }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Quantity')</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ $order->quantity }}"
                                           class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Start Counter')</label>
                                    <input type="number" name="start_counter"
                                           value="{{ old('link',$order->start_counter) }}"
                                           placeholder="{{ __('start counter') }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Interval')</label>
                                    <input type="number" name="interval" value="{{ $order->interval }}"
                                           placeholder="{{ __('interval') }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Runs')</label>
                                    <input class="form-control" type="text" placeholder="{{ __('runs') }}" value="{{ $order->runs }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('API Provider')</label>
                                    <input class="form-control" type="text" placeholder="{{ __('API Provider') }}"
                                           value="{{ optional(optional($order->service)->provider)->api_name }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('API Order ID')</label>
                                    <input class="form-control" type="text" placeholder="{{ __('API Order ID') }}" value="{{ $order->api_order_id }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label>@lang('API Response')</label>
                            <textarea class="form-control" placeholder="{{ __('API Response') }}" disabled>{{ $order->status_description }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('Link')</label>
                            <input type="text" name="link" value="{{ old('link',$order->link) }}"
                                   placeholder="www.example.com/your_profile_identity" class="form-control">
                            @error('link')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Remains')</label>
                                    <input type="number" name="remains" value="{{ old('remains',$order->remains) }}"
                                           placeholder="remains" class="form-control">
                                    @error('remains')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Start counter')</label>
                                    <input class="form-control" type="number" name="start_counter" id="start_counter"
                                           value="{{ old('start_counter',$order->start_counter) }}">
                                    @error('start_counter')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="{{ isset($order->refilled_at) ? 'col-md-6' : 'col-md-12' }}">
                                <div class="form-group">
                                    <label>@lang('Change Status')</label>
                                    <select class="form-control" id="status" name="status">
                                        <option
                                            value="awaiting" {{ $order->status == 'awaiting' ? 'selected' : '' }}>@lang('Awaiting')</option>
                                        <option
                                            value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>@lang('Pending')</option>
                                        <option
                                            value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>@lang('Processing')</option>
                                        <option
                                            value="progress" {{ $order->status == 'progress' ? 'selected' : '' }}>@lang('In progress')</option>
                                        <option
                                            value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>@lang('Completed')</option>
                                        <option
                                            value="partial" {{ $order->status == 'partial' ? 'selected' : '' }}>@lang('Partial')</option>
                                        <option
                                            value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>@lang('Canceled')</option>
                                        <option
                                            value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>@lang('Refunded')</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if(isset($order->refilled_at))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Change Refill Status')</label>
                                        <select class="form-control" id="refill_status" name="refill_status">
                                            <option
                                                value="awaiting" {{ $order->refill_status == 'awaiting' ? 'selected' : '' }}>@lang('Awaiting')</option>
                                            <option
                                                value="pending" {{ $order->refill_status == 'pending' ? 'selected' : '' }}>@lang('Pending')</option>
                                            <option
                                                value="processing" {{ $order->refill_status == 'processing' ? 'selected' : '' }}>@lang('Processing')</option>
                                            <option
                                                value="progress" {{ $order->refill_status == 'progress' ? 'selected' : '' }}>@lang('In progress')</option>
                                            <option
                                                value="completed" {{ $order->refill_status == 'completed' ? 'selected' : '' }}>@lang('Completed')</option>
                                            <option
                                                value="partial" {{ $order->refill_status == 'partial' ? 'selected' : '' }}>@lang('Partial')</option>
                                            <option
                                                value="canceled" {{ $order->refill_status == 'canceled' ? 'selected' : '' }}>@lang('Canceled')</option>
                                            <option
                                                value="refunded" {{ $order->refill_status == 'refunded' ? 'selected' : '' }}>@lang('Refunded')</option>
                                        </select>
                                        @error('refill_status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group ">
                            <label>@lang('Note')</label>
                            <textarea class="form-control" name="reason" rows="5">{{ $order->reason }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                    <button type="submit" class=" btn  btn-primary btn-block mt-3">
                        <span>@lang('Submit')</span></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('extra-script')
    <script>
        "use strict";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#category').on('change', function (e) {
                let cat_id = $('option:selected', this).val();
                // console.log(cat_id)
                $.ajax({
                    url: "{{ route('admin.service') }}",
                    type: "POST",
                    data: {cat_id: cat_id},
                    success: function (data) {
                        $('#service').html('');
                        if (data.length) {
                            $(data).each(function (key, val) {
                                if (key == 0) {
                                    $('#service').append('<option value="" disabled selected>Select Service</option>');
                                }
                                $('#service').append('<option value="' + val.id + '">' + val.service_title + '</option>');
                            });
                        }
                    }
                })
            });

        });
    </script>
@endpush
