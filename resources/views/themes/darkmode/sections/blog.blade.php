@if(isset($contentDetails['blog']))
    @if(0 < count($contentDetails['blog']))
        <!-- BLOG -->
        <section class="blog-section">
            <div class="container">
                <div class="row g-4">
                        @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
                            <div class="col">
                                <div class="header-text text-center">
                                    <h5>@lang($blog->description->sub_title)</h5>
                                    <h3>@lang($blog->description->short_title)</h3>
                                </div>
                            </div>
                        @endif
                </div>

                <div class="row g-4">
                    @foreach($contentDetails['blog']->take(3)->sortDesc()->shuffle() as $key => $data)
                        <div class="col-lg-4">
                            <div class="blog-box">
                                <div class="img-box">
                                <img
                                    src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                    alt="@lang(Str::limit($data->description->title,40))"
                                    class="img-fluid"
                                />
                                </div>
                                <div class="text-box">
                                    <h4>@lang(Str::limit($data->description->title,40))</h4>
                                    <div class="date-author">
                                        <span class="date">{{dateTime($data->created_at,'d M Y')}}</span>
                                        <span class="author">@lang('Admin')</span>
                                    </div>
                                    <p>@lang(Str::limit($data->description->description,120))</p>
                                    <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}" class="read-more">
                                        @lang('Read More')...
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /BLOG -->
    @endif
@endif
