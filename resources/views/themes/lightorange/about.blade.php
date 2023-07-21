@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('content')
    @include($theme.'sections.feature')
    @include($theme.'sections.about')
    @include($theme.'sections.counter')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.gateways')
    @include($theme.'sections.news-letter')
@endsection
