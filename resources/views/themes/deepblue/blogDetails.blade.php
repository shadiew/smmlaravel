@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')
<!-- BLOG Details-->
<section class="blog-section">
    <div class="container">
        <div class="row gy-5 g-lg-5">
            <div class="col-lg-8">
                <div class="blog-box details">
                    <div class="img-box">
                        <img src="{{$singleItem['image']}}" alt="@lang($singleItem['title'])" class="img-fluid" />
                    </div>
                    <div class="text-box">
                        <div class="date-author">
                            <span class="date">{{$singleItem['date']}}</span>
                            <span class="author">@lang('Admin')</span>
                        </div>
                        <h3>@lang($singleItem['title'])</h3>
                    </div>
                    <div class="description">
                        <p>@lang($singleItem['description'])</p>
                    </div>
                </div>
            </div>

            @if(isset($popularContentDetails['blog']))
                @if(0 < count($popularContentDetails['blog']))
                <div class="col-lg-4">
                    <h4 class="mb-3">@lang('Recent Posts')</h4>
                    @foreach($popularContentDetails['blog']->sortDesc()->shuffle() as $data)
                        <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}">
                            <div class="recent-post blog-box">
                                <div class="img-box">
                                    <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="@lang($data->description->title)" class="img-fluid" />
                                </div>
                                <div class="text-box">
                                    <h4>@lang(Str::limit($data->description->title,35))</h4>
                                    <div class="date-author">
                                        <span class="date">{{dateTime($data->created_at,'d M, Y')}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif
            @endif
        </div>
    </div>
</section>
<!-- /BLOG Details -->
@endsection
