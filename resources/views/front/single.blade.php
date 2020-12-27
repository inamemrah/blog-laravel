
@extends('front.layouts.master')

@section('title', $article->title)

@section('content')

    <div class="col-md-9 mx-auto">
        {!!$article->content!!}

        <span class="text-danger"> Okunma Sayısı: <b>{{$article->hit}}</b></span>
    </div>

@include('front.widgets.categoryWidget')
@endsection
