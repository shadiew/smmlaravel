@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')
    @include($theme.'sections.blog')
    @include($theme.'sections.news-letter')
@endsection
