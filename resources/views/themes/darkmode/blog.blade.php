@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

    <!-- BLOG -->
    @if(isset($contentDetails['blog']))
        <section class="blog-section">
            <div class="container">
                <div class="row g-4">
                    @foreach($contentDetails['blog']->sortDesc()->shuffle() as $key => $data)
                        <div class="col-lg-4">
                            <div class="blog-box">
                                <div class="img-box">
                                <img
                                    src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="{{@$data->description->title}}"
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
                                <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}" class="read-more"
                                    >@lang('Read More')...
                                </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- /BLOG -->

@endsection
