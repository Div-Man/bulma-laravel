



@extends('layouts/app')
@section('content')
      <section class="hero is-primary">
        <div class="hero-body">
          <div class="container">
            <h2 class="subtitle">
             Всё видео
            </h2>
          </div>
        </div>
      </section>
      <section class="section main-content">
        <div class="container">
          <div class="columns  is-multiline">
              
            @foreach($videos as $video)
                  <div class="column is-one-quarter">
              <div class="card">
                <div class="card-image">
                        <iframe 
                            width="100%" height="50%"
                            src="https://www.youtube.com/embed/{{$video->url}}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen> 
                        </iframe>
                     
                </div>
                <div class="card-content">
                  <div class="media">
                   
                    <p class="title is-5"><a href="/show/video/{{$video->id}}">{{$video->title}}</a></p>
                   
                  </div>
                </div>
              </div>
            </div>
            @endforeach     
          </div>
        </div>
      </section>
       @endsection