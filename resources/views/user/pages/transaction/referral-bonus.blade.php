@extends('user.layouts.app')
@section('title')
    @lang($title)
@endsection
@section('content')
    <div class="container-fluid px-3 user-service-list">

        <div class="row justify-content-between mx-lg-5">
            <div class="col-md-12">

                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang($title)</li>
                </ol>

                <div class="card my-3">
                    <div class="card-body">
                        <form action="{{route('user.referral.bonus.search')}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="search_user"
                                               value="{{@request()->search_user}}"
                                               class="form-control"
                                               placeholder="@lang('Search User')">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="datetrx" id="datepicker"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn waves-effect waves-light w-100 btn-primary"><i class="fas fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-3 justify-content-between mx-lg-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">

                        <div class="table-responsive">
                            <table class="table  table-striped " id="service-table">
                                <thead>
                                <tr>
                                    <th>@lang('SL No.')</th>
                                    <th>@lang('Bonus From')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Remarks')</th>
                                    <th>@lang('Time')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td data-label="@lang('SL No.')">
                                            {{loopIndex($transactions) + $loop->index}}</td>
                                        <td data-label="@lang('Bonus From')">@lang(optional($transaction->bonusBy)->fullname)</td>
                                        <td data-label="@lang('Amount')">
                                                    <span
                                                        class="font-weight-bold text-success">{{getAmount($transaction->amount, config('basic.fraction_number')). ' ' . trans(config('basic.currency'))}}</span>
                                        </td>

                                        <td data-label="@lang('Remarks')"> @lang($transaction->remarks)</td>
                                        <td data-label="@lang('Time')">
                                            {{ dateTime($transaction->created_at, 'd M Y h:i A') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="100%">{{trans('No Data Found!')}}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                        {{ $transactions->appends($_GET)->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extra-script')
@endpush
