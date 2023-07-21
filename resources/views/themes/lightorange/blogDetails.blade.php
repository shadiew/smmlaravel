@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')

    <!-- blog_details_area_start -->
    <section class="blog_details_area">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-8 order-2 order-md-1">
                    <div class="blog_details">
                        <div class="blog_image">
                            <img src="{{@$singleItem['image']}}" alt="@lang(@$singleItem['title'])" class="img-fluid">
                        </div>
                        <div class="blog_header py-3">
                            <div class="date_author d-flex">
                                <span><a href=""><i class="far fa-user"></i>@lang('Admin')</a></span>
                                <span><i class="far fa-calendar-alt"></i>{{@$singleItem['date']}}</span>
                            </div>
                            <h3 class="mt-30">@lang(@$singleItem['title'])</h3>
                        </div>
                        <div class="blog_para">
                            <p>@lang(@$singleItem['description'])</p>
                        </div>
                    </div>

                </div>
                @if(isset($popularContentDetails['blog']))
                    @if(0 < count($popularContentDetails['blog']))
                        <div class="col-md-4 order-1 order-md-2">
                            <div class="blog_sidebar">
                                <div class="section_header">
                                    <h4>@lang('Recent Post')</h4>
                                </div>
                                @foreach($popularContentDetails['blog']->sortDesc()->shuffle() as $data)
                                    <div class="blog_widget_area">
                                        <ul>
                                            <li>
                                                <a href="{{route('blogDetails',[slug(@$data->description->title), @$data->content_id])}}" class="d-flex">
                                                    <div class="blog_widget_image">
                                                        <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                                             alt="@lang(@$data->description->title)" class="img-fluid">
                                                    </div>
                                                    <div class="blog_widget_content">
                                                        <h6 class="blog_title">
                                                            @lang(Str::limit(@$data->description->title,35))
                                                        </h6>
                                                        <div class="blog_date">
                                                            <div class="blog_item1">{{dateTime(@$data->created_at,'d M, Y')}}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
    <!-- blog_details_area_start -->
@endsection
