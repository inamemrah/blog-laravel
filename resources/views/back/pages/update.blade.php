@extends('back.layouts.master')
@section('title', $page->title . ' Sayfasını Güncelle')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            <form class="" action="{{route('admin.page.update', $page->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" name="title" value={{$page->title}} class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Makale Fotoğrafı</label><br>
                    <img src="{{asset($page->images)}}" width="300" class="rounded">
                    <input type="file" name="image" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label>Makale İçeriği</label>
                    <textarea id="editor" name="content" class="form-control">{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
                </div>
            </form>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            'height': 300
        });
    });
</script>
@endsection
