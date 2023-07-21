@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')
    <!-- contact_area_start -->
    <section class="contact_page">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="contact_area">
                        <div class="section_header mb-0">
                            <div class="section_subtitle">@lang(@$contact->title)</div>
                            <h3>@lang(@$contact->sub_heading)</h3>
                        </div>
                        <p class="para_text">@lang(@$contact->sub_title)</p>
                        <h6 class="mt-30 mb-0">@lang('Phone'):</h6>
                        <p>{{@$contact->phone}}</p>
                        <h6 class="mt-30 mb-0">@lang('Email'):</h6>
                        <p>{{@$contact->email}}</p>
                        <h6 class="mt-30 mb-0">@lang('Address'):</h6>
                        <p>{{@$contact->address}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact_message_area text-center">
                        <form action="{{route('contact.send')}}" method="post">
                            @csrf
                            <div class="form_title text-start mb-30">
                                <h3>@lang(@$contact->heading)</h3>
                                <p>@lang(@$contact->sub_heading)</p>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <input class="form-control"
                                           type="text"
                                           name="name"
                                           value="{{old('name')}}"
                                           placeholder="@lang('Full name')">
                                    @error('name')
                                    <span class="text-danger">@lang($message)</span>
                                    @enderror

                                </div>
                                <div class="mb-3 col-md-6">
                                    <input class="form-control"
                                           type="email"
                                           name="email" value="{{old('email')}}"
                                           placeholder="@lang('Email address')">
                                    @error('email')
                                    <span class="text-danger">@lang($message)</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <input class="form-control"
                                           type="text"
                                           name="subject" value="{{old('subject')}}"
                                           placeholder="@lang('Subject')">
                                    @error('subject')
                                        <span class="text-danger">@lang($message)</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <textarea class="form-control"
                                              name="message"
                                              cols="30"
                                              rows="3"
                                              placeholder="@lang('Your message')">{{old('message')}}</textarea>
                                </div>
                            </div>
                            <div class="btn_area d-flex">
                                <button type="submit" class="custom_btn mt-30 top-right-radius-0">{{trans('Send Message')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- contact_area_end -->

    @include($theme.'sections.news-letter')
@endsection
