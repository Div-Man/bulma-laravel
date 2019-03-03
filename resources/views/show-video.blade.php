 @extends('layouts/app')
@section('content')

    <br>
    <br>
      <div class="container main-content">
        <div class="columns">
          <div class="column"></div>
          <div class="column is-half auth-form">
            <div class="card">
              <div class="card-image">
               
                     <iframe 
                            width="100%" height="400px"
                            src="https://www.youtube.com/embed/{{$video->url}}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen> 
                        </iframe>
                
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-left">
                    <figure class="image is-48x48">
                      <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                    </figure>
                  </div>
                    <p class="title is-4">
                      Добавил: <a href="#">{{$video->user->name}}</a>
                    </p>
                </div>

                <div class="content">
                 {{$video->description}}
                  <br>
                  <time datetime="2016-1-1" class="is-size-6 is-pulled-left">Добавлено: {{$video->created_at}}</time>
                  <a href="#" class="button is-info is-pulled-right">Скачать</a>
                  <div class="is-clearfix"></div>
                </div>
              </div>
            </div>
           
          </div>
          <div class="column"></div>
        </div>
        
        <hr>
        
         <div class="comment_tab">
        {{$commentsCount}} комментарий
    </div>
    <br>
    
    <div id="comment_section">

 
    </div>


    <div id="comment_form">
        <h3>Добавить свои мысли</h3>

        <form action="/store-comment-video" method="post" enctype="multipart/form-data">
            {{csrf_field()}} 
            <input name="video_id" type="hidden" value="{{$video->id}}">
            
            <!-- id юзера который создал тему, он нужен для уведомлений-->
            <input name="user_video_id" type="hidden" value="{{$video->user->id}}">
            
            <!-- id юзера который оставил коммент-->
            <input name="user_comment_id" type="hidden" value="{{Auth::id()}}">
            <div class="form_row">
                <label>Your comment</label><br />
                <textarea name="text" rows="" cols=""></textarea>
            </div>
            <input type="submit" name="Submit" value="Submit" class="submit_btn" />
        </form>

    </div>

      
      </div>

 @endsection