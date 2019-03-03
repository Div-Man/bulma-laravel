<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta class="token" name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Hello Bulma!</title>
    
    <script defer src="/js/all.js"></script>
    <link rel="stylesheet" href="/css/bulma.css">
    
    
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/select-multiple.css">
    <link rel="stylesheet" href="/css/comments.css">
    
    <style>
        	#photoInput {
		display: none;
	}
	
	.img-circle {
		width: 400px;
		height: 210px;
		border: 1px solid;
		object-fit: cover;
	}
	
    </style>
    
    
  <!-- Аккуратно, из-за конфликтов, стиои могут послетать -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <nav class="navbar is-transparent">
          <div class="navbar-brand">
            <a class="navbar-item" href="index.html">
              <img src="/img/bulma-logo.png" width="112" height="28">
            </a>
            <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>

          <div id="navbarExampleTransparentExample" class="navbar-menu">
            <div class="navbar-start">
              <a class="navbar-item" href="/">
                Главная
              </a>
                
                
              <div class="navbar-item has-dropdown is-hoverable">

                       @foreach ($category as $sub_cat)
                      <li class="navbar-link"><a class="" data-toggle="dropdown" href="#">{{$sub_cat->category_name}}</a>
                       <ul class="dropdown-menu">
                           <li><a href="/show-all-{{$sub_cat->title_in_english}}">Все</a></li>
                        @foreach($sub_cat->subCategories as $sub_category) 
                            @if ($sub_category->id_category === 1)

                                <li><a href="/category/{{$sub_category->id}}">
                                    {{$sub_category->sub_category_name}} ({{$sub_category->images->count()}})
                               </a></li>
                            @elseif ($sub_category->id_category === 2)
                             <li><a href="/category-video/{{$sub_category->id}}">
                                    {{$sub_category->sub_category_name}} ({{$sub_category->videos->count()}})
                               </a></li>
                           @endif
                        @endforeach
                          </ul>
                  @endforeach
                  </li>
              </div>
            </div>
             
              
             @if (Auth::check())
              <div class="navbar-end">
              <div class="navbar-item">
                <div class="field is-grouped">
                  <div class="dropdown is-hoverable">
                      
                      <div class="dropdown-trigger">
                          <button class="button is-primary" aria-haspopup="true" aria-controls="dropdown-menu4">
                              <span>Управление</span>
                              <span class="icon is-small">
                                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                                </span>
                          </button>
                      </div>
                      <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                          <div class="dropdown-content">
                              <div class="dropdown-item manager-links">
                                  <p style="margin-bottom: 5px;" class="control">
                                      <a class="button" href="/image/upload">
                                            <span class="icon">
                                              <i class="fas fa-upload"></i>
                                            </span>
                                          <span>Загрузить картинку</span>
                                      </a>
                                  </p>
                                   <p style="margin-bottom: 5px;" class="control">
                                      <a class="button" href="/video/upload">
                                            <span class="icon">
                                              <i class="fas fa-upload"></i>
                                            </span>
                                          <span>Загрузить видео</span>
                                      </a>
                                  </p>

                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="account control">
                    <p>
                      Здравствуйте, <b>{{ Auth::user()->name}}</b>
                    </p>
                  </div>
                    
                    <p class="control blink">
                    <a style="
                       background: red; 
                       @if($notificationsCount != 0)
                         animation: blink 1s infinite
                       @endif
                       " 
                       
                       class="button is-info" href="/read-notif">
                      <span class="icon">
                        <i class="fas fa-eye"></i>
                      </span>
                      <span>Уведомления <span>({{$notificationsCount}})</span></span>
                    </a>
                  </p>
                    
                  <p class="control">
                    <a class="button is-info" href="/my-profile">
                      <span class="icon">
                        <i class="fas fa-user"></i>
                      </span>
                      <span>Профиль</span>
                    </a>
                  </p>
                  <p class="control">
                    <a class="button is-dark" href="/logout" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();
                        ">
                      <span class="icon">
                        <i class="fas fa-window-close"></i>
                      </span>
                      <span>Выйти</span>
                      
                    </a>
                       <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        {{csrf_field()}}
                   </form>
                  </p>
                </div>
              </div>
            </div>
             @else
            <div class="navbar-end">
              <div class="navbar-item">
                <div class="field is-grouped">
                  <p class="control">
                    <a class="button is-link" href="/login">
                      <span class="icon">
                        <i class="fas fa-user"></i>
                      </span>
                      <span>Войти</span>
                    </a>
                  </p>
                  <p class="control">
                    <a class="button is-primary" href="/register">
                      <span class="icon">
                        <i class="fas fa-address-book"></i>
                      </span>
                      <span>Зарегистрироваться</span>
                    </a>
                  </p>
                </div>
              </div>
            </div>
              @endif
                 
          </div>
        </nav>
      </div>
       
            @yield('content')
       
   <footer class="section hero is-light">
          <div class="container">
            <div class="content has-text-centered">
              
              <p>
                <strong>Кахаров Дмитрий</strong> - ещё одна попытка сделать сайт на Laravel.
              </p>
              <p class="is-size-7">
                Права не защищены 24 февраля, воскресенье 2019, пол-шестого скоро ужин.
              </p>
            </div>
          </div>
      </footer>
    </div>
  </body>

  <script>
    document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
  </script>
</html>
