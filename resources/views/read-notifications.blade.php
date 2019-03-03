@extends('layouts/app')
@section('content')

      <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
          <div class="container">
            <h1 class="title">
              Самые минималистичные и элегантные обои для вашего рабочего стола!
            </h1>
            <h2 class="subtitle">
              Настроение и вдохновение в одном кадре.
            </h2>
          </div>
        </div>
      </section>
      <section class="section main-content">
        <div class="container">
           
           @foreach ($allData as $data)
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$data['name']}}, оставил комментарий на изображение - {{$data['title']}}</h5>
                  <div class="card-text">{!!$data['text']!!}</div>
                  <br>
                  <a href="/show/image/{{$data['post_id']}}" class="btn btn-primary">Перейти</a>
                  <a href="/mark-notif-read/{{$data['id_notif']}}" class="btn btn-primary">Отменить прочитанным</a>
                </div>
             </div>
           <br>
            @endforeach
            
            
             @foreach ($allDataReply as $data)
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$data['name']}}, ответил на ваш комментарий - {{$data['title']}}</h5>
                  <div class="card-text">{!!$data['text']!!}</div>
                  <br>
                  <a href="/show/image/{{$data['post_id']}}" class="btn btn-primary">Перейти</a>
                  <a href="/mark-notif-read/{{$data['id_notif']}}" class="btn btn-primary">Отменить прочитанным</a>
                </div>
             </div>
           <br>
            @endforeach
            
            
           
            
        </div>
      </section>
      @endsection