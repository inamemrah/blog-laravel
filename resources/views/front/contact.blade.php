
@extends('front.layouts.master')

@section('title', 'İletişim')

@section('content')

  <div class="col-md-8">
    @if(session('success'))
      <div class="alert alert-success">
          {{session('success')}}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{route('contact.post')}}">
      @csrf
      <div class="control-group">
        <div class="form-group controls">
          <label>Ad Soyad</label>
          <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group controls">
          <label>Email Adresi</label>
          <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{old('email')}}">
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group col-xs-12 controls">
          <label>Konu</label>
          <select class="form-control" name="topic">
              <option>Bilgi</option>
              <option>Destek</option>
              <option>Genel</option>
          </select>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group controls">
          <label>Mesaj</label>
          <textarea rows="5" class="form-control" placeholder="Message" name="message">{{old('message')}}</textarea>
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <br>
      <div id="success"></div>
      <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
    </form>
  </div>
  <div class="col-md-4">
    <div class="card card-default">
      <div class="card-body">Panel Content</div>
      Adres: fdssfdfsd
    </div>
  </div>

@endsection
