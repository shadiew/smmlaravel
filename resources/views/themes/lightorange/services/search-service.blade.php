@extends($theme.'layouts.app')
@section('title', trans('Search Services'))

@section('content')
    <!-- _service_area_page_start -->
    <section class="service_page_area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="search_area shadow3">
                        <form action="{{ route('service.search') }}" method="get">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="input_box">
                                        <input name="service" value="{{@request()->service}}" class="form-control" placeholder="@lang('Search for Services')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input_box">
                                        <select class="form-select statusfield" aria-label="Default select example" name="category" id="category">
                                            <option value="">@lang('All Category')</option>
                                            @foreach($categories as $category)
                                                <option value="{{@$category->id}}" {{(@$category->id == @request()->category) ? 'selected' : ''}}>@lang($category->category_title)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input_box">
                                        <button type="submit" class="custom_btn w-100"><i class="fas fa-search" aria-hidden="true"></i>
                                            @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        @forelse($services as $key => $service)
                                <div class="accordion-item shadow2">
                                    <h2 class="accordion-header" id="heading{{slug($key)}}">
                                        <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{slug($key)}}" aria-expanded="true" aria-controls="collapse{{slug($key)}}">
                                            @lang($key)
                                        </button>
                                    </h2>
                                    <div id="collapse{{slug($key)}}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{slug($key)}}"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">@lang('ID')</th>
                                                        <th scope="col">@lang('Name')</th>
                                                        <th scope="col">@lang('Rate Per 1K')</th>
                                                        <th scope="col">@lang('Min')</th>
                                                        <th scope="col">@lang('Max')</th>
                                                        <th scope="col">@lang('Description')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($service as $key => $row)
                                                        <tr>
                                                            <td data-label="id" scope="row">{{@$row->id}}</td>
                                                            <td data-label="name">@lang(@$row->service_title)</td>
                                                            <td data-label="rate">@lang(config('basic.currency_symbol')){{(@$row->user_rate) ?? @$row->price}}</td>
                                                            <td data-label="min">@lang(@$row->min_amount)</td>
                                                            <td data-label="max">@lang(@$row->max_amount)</td>
                                                            <td data-label="description">
                                                                <button data-bs-toggle="modal" data-bs-target="#describeModal"
                                                                        id="details"
                                                                        data-servicetitle="{{$row->service_title}}"
                                                                        data-id="{{$row->id}}"
                                                                        data-description="{{$row->description}}"
                                                                        class="border-0">
                                                                    <i class="fal fa-eye"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @empty
                            <p class="text-center mt-2">@lang('No Data Found')</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- _service_area_page_end -->

    <!-- service_page_modal_start -->
    <div class="service_page_modal">
        <!-- Modal -->
        <div class="modal fade" id="describeModal" tabindex="-1" aria-labelledby="exampleModallebel" aria-hidden="true"
             data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title"></h5>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="servicedescription"></p>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="custom_btn btn2" data-bs-dismiss="modal">@lang('Close')</a>
                        <a href="" type="submit" class="custom_btn order-now">@lang('Order Now')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service_page_modal_start -->
@endsection


@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '#details', function () {
                var title = $(this).data('servicetitle');
                var description = $(this).data('description');

                var id = $(this).data('id');
                var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;
                $('.order-now').attr('href', orderRoute);

                $('#title').text(title);
                $('#servicedescription').html(description);
            });
        });
    </script>
@endpush
