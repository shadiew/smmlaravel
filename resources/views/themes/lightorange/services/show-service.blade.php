@extends($theme.'layouts.app')
@section('title', trans('Services'))

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
                        @foreach($categories as $key => $category)
                            @if( 0 < count(@$category->service))
                                <div class="accordion-item shadow2">
                                    <h2 class="accordion-header" id="heading{{@$category->id}}">
                                        <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{@$category->id}}" aria-expanded="true" aria-controls="collapse{{@$category->id}}">
                                            @lang(@$category->category_title)
                                        </button>
                                    </h2>
                                    <div id="collapse{{@$category->id}}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{@$category->id}}"
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
                                                    @foreach($category->service as $service)
                                                        <tr>
                                                        <td data-label="id" scope="row">{{@$service->id}}</td>
                                                        <td data-label="name">@lang(@$service->service_title)</td>
                                                        <td data-label="rate">@lang(config('basic.currency_symbol')){{(@$service->user_rate) ?? @$service->price}}</td>
                                                        <td data-label="min">@lang(@$service->min_amount)</td>
                                                        <td data-label="max">@lang(@$service->max_amount)</td>
                                                            <td data-label="description">
                                                                <button data-bs-toggle="modal" data-bs-target="#describeModal"
                                                                        class="details border-0"
                                                                        data-id="{{@$service->id}}"
                                                                        data-servicetitle="{{@$service->service_title}}"
                                                                        data-description="{{@$service->description}}">
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
                            @endif

                        @endforeach
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
                        <a type="button" class="btn btn-secondary " data-bs-dismiss="modal">@lang('Close')</a>
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
            $(document).on('click', '.details', function () {
                var title = $(this).data('servicetitle');
                var id = $(this).data('id');

                var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;
                $('.order-now').attr('href', orderRoute);

                var description = $(this).data('description');
                $('#title').text(title);
                $('#servicedescription').html(description);
            });
    </script>
@endpush
