
@foreach($images->images as $image)
    @php
        //dump($image);
    @endphp
@endforeach


@extends('layouts/app')
@section('content')
      <section class="hero is-primary">
        <div class="hero-body">
          <div class="container">
            <h1 class="title">
               {{$images->sub_category_name}}
            </h1>
            <h2 class="subtitle">
              Картинки по категориям
            </h2>
          </div>
        </div>
      </section>
      <section class="section main-content">
        <div class="container">
          <div class="columns  is-multiline">
              
            @foreach($images->images as $image)
                  <div class="column is-one-quarter">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <a href="/show/image/{{$image->id}}">
                      <img src="/{{$image->url}}" alt="">
                    </a>
                  </figure>
                </div>
                <div class="card-content">
                  <div class="media">
                    <div class="media-left">
                    <p class="title is-5"><a href="category.html">{{$image->title}}</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach     
          </div>
        </div>
      </section>
       @endsection