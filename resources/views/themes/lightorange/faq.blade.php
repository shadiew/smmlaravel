@extends($theme.'layouts.app')
@section('title', trans('Frequently Asked Questions'))

@section('content')
    @include($theme.'sections.faq')
    @include($theme.'sections.news-letter')
@endsection
