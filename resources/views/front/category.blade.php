
@extends('front.layouts.master')

@section('title', $category->name)

@section('content')
  
<div class="col-md-9">
    @include('front.widgets.articleList')
</div>


@include('front.widgets.categoryWidget')
@endsection
