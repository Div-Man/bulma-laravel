@extends('layouts/app')
@section('content')





@php
//dump($image);
@endphp

<div class="container main-content">
    <div class="columns">
        <div class="column"></div>
        <div class="column is-half auth-form">
            @if(Session::has('newImage'))
            <div class="notification is-success">
                {{ Session::get('newImage') }}
            </div>
            @endif
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="/{{$image->url}}" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <p class="title is-4">
                            Добавил: <a href="#">{{$image->user->name}}</a>
                        </p>
                    </div>

                    <div class="content">
                        {{$image->description}}
                        <br>
                        <time datetime="2016-1-1" class="is-size-6 is-pulled-left">Добавлено: {{$image->created_at}}</time>
                        <div class="is-clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="column"></div>
    </div>

    <div class="comment_tab">
        {{$commentsCount}} комментарий
    </div>
    <br>
    <div id="comment_section">

        <ol class="comments first_level">
            @foreach($comments as $comment)
            <li>
                <div class="comment_box commentbox1">

                    <div class="gravatar">
                        <img src="/{{$comment->getUserAvatar($comment->user_id)}}" alt="author 1" />
                    </div>

                    <div class="comment_text">
                        <div class="comment_author">{{$comment->getUserName($comment->user_id)}}<span class="date">24 August 2048</span><span class="time">12:12 pm</span></div>
                        {!!$comment->text!!}

                        @if(Auth::id() != $comment->user_id)
                        <div class="reply"><a data-user-name="{{$comment->getUserName($comment->user_id)}}" data-user-id="{{$comment->user_id}}" href="#">Ответить</a></div>
                        @endif
                    </div>
                    <div class="cleaner"></div>
                </div>                        

            </li>

            @endforeach


            <li class="ajax-new-comment">


            </li>


        </ol>
    </div>



    <div id="comment_form">
        <h3>Добавить свои мысли</h3>

        <form id="all-contactform" action="/store-comment" method="post" enctype="multipart/form-data">
            {{csrf_field()}} 
            <input name="image_id" type="hidden" value="{{$image->id}}">

            <!-- id юзера который создал тему, он нужен для уведомлений-->
            <input name="user_image_id" type="hidden" value="{{$image->user->id}}">
            <input name="reply_user_id" class="reply-user-id" type="hidden" value="">

            <!-- id юзера который оставил коммент
            
            <input name="user_comment_id" type="hidden" value="{{Auth::id()}}">-->
            <div class="form_row">
                <label>Your comment</label><br />
                <textarea name="text" style="display:none;" class="copy-write-comment" rows="" cols=""></textarea>
                <br>
                <p style="
                   padding: 10px; 
                   background: white; 
                   width: 50%;
                   height: 150px;" 

                   contenteditable="true" class="write-comment"></p>
            </div>
            <input id="contactform" type="submit" name="Submit" value="Submit" class="submit_btn" />
        </form>

    </div>
    <script>



        $(document).ready(function () {
            $('#contactform').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: '/store-comment',
                    dataType: 'json',
                    data: $('#all-contactform').serialize(),
                    success: function (result) {

                        var newComment = ' <div class="comment_box commentbox1">\n\
                            <div class="gravatar">\n\
                           <img src="/' + result.userAvatar + '" alt="author 1" />\n\
                           </div>\n\
                           <div class="comment_text">\n\
                           <div class="comment_author">' + result.userName + '<span class="date">24 August 2048</span><span class="time">12:12 pm</span></div>\n\
                            ' + result.comment + '</div>\n\
                           <div class="cleaner"></div>\n\
                           </div>\n\
                           ';


                        $('.ajax-new-comment').append(newComment);
                        console.log(result);
                    }
                });
            });
        });




        var reply = document.querySelectorAll('.reply');
        var formComment = document.querySelector('.write-comment');
        var formCommentCopy = document.querySelector('.copy-write-comment');
        var replyUserId = document.querySelector('.reply-user-id');


        reply.forEach(function (element, i) {
            reply[i].addEventListener('click', function (e) {
                e.preventDefault();
                var userName = e.target.dataset.userName;
                var userId = e.target.dataset.userId;

                var userNameHtml = document.createElement('b');
                var descriptionComment = document.createElement('div');
                descriptionComment.style.display = 'inline-block';
                userNameHtml.innerHTML = userName + ',';
                descriptionComment.innerHTML = '&nbsp;';

                formComment.appendChild(userNameHtml);
                formComment.appendChild(descriptionComment);

                formCommentCopy.innerHTML = userNameHtml + ', ';
                replyUserId.value = userId;
            });
        });


        formComment.addEventListener('input', function () {
            formCommentCopy.innerHTML = formComment.innerHTML
        });
    </script>

</div>

@endsection