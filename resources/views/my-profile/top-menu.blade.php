@extends('layouts/app')
@section('content')
<div class="container main-content">

    <div class="columns">
        <div class="column">
            <div class="tabs is-centered pt-100">
                <ul>
                    <li class="is-active">
                        <a href="profile-info.html">
                            <span class="icon is-small"><i class="fas fa-user"></i></span>
                            <span>Основная информация</span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile-security">
                            <span class="icon is-small"><i class="fas fa-lock"></i></span>
                            <span>Безопасность</span>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="is-clearfix"></div>
             <form action="/update-profile" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
            <div class="columns is-centered">
               
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Ваше имя</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" value="{{ Auth::user()->name}}" disabled>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" value="{{ Auth::user()->email}}" disabled>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>



                    <div class="field">
                        <label class="label">Аватар</label>
                        <div>
                            <img src="{{$avatar}}" class="img-circle" id="theImage">
                        </div>

                        <br>
                        <div class="file is-normal has-name">
                            <label class="file-label">
                                <input class="file-input" id="photoInput" type="file" name="image">

                            </label>
                        </div>
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="addImg file-label">
                                Выбрать файл
                            </span>
                        </span>
                    </div>

                    <script>
                        var btn = document.querySelector(".addImg");
                        var photoFile = document.getElementById("photoInput");
                        btn.addEventListener('click', function () {
                            photoFile.click();
                        })
                        var fileReader = new FileReader();
                        fileReader.addEventListener('load', function () {
                            theImage.src = this.result;
                        });
                        photoInput.addEventListener('change', function (e) {
                            var file = e.target.files[0];
                            fileReader.readAsDataURL(file);
                        });
                    </script>


                    <div class="control">
                        <button class="button is-link">Обновить</button>
                    </div>
                </div>
                
            </div>
                 </form>
        </div>
    </div>
</div>
@endsection