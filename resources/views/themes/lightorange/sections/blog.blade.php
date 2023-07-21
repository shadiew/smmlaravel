<div class="shape2"><img src="{{ asset($themeTrue.'img/shape2.png') }}" alt=""></div>

<!-- blog_area_start -->
@if(isset($contentDetails['blog']))
    @if(0 < count($contentDetails['blog']))
        <section class="blog_area">
            <div class="container">
                <div class="row">
                    @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
                        <div class="section_header mb-50 text-center">
                            <div class="section_subtitle">@lang(@$blog->description->sub_title)</div>
                            <h2>@lang(@$blog->description->short_title)</h2>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center g-lg-4 gy-5">
                    @foreach($contentDetails['blog']->take(3)->sortDesc()->shuffle() as $key => $data)
                         <div class="col-lg-4 col-sm-6">
                            <div class="blog_box box1">
                                <div class="image_area">
                                    <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                         alt="@lang(Str::limit(@$data->description->title,40))"
                                         class="img-fluid">
                                </div>

                                <div class="text_area">
                                    <div class="date_author d-flex justify-content-between">
                                        <span><a href=""><i class="far fa-user"></i>@lang('Admin')</a></span>
                                        <span><i class="far fa-calendar-alt"></i>{{dateTime(@$data->created_at,'d M Y')}}</span>
                                    </div>
                                    <h5 class="pt-3"><a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">@lang(Str::limit(@$data->description->title,40))</a></h5>
                                    <p class=" pb-20">@lang(Str::limit(@$data->description->description,120))</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
<!-- blog_area_end -->
