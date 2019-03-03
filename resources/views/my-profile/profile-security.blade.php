@extends('layouts/app')
@section('content')
      <div class="container main-content">

        <div class="columns">
            <div class="column">
              <div class="tabs is-centered pt-100">
                <ul>
                  <li>
                    <a href="/my-profile">
                      <span class="icon is-small"><i class="fas fa-user"></i></span>
                      <span>Основная информация</span>
                    </a>
                  </li>
                  <li class="is-active">
                    <a href="#">
                      <span class="icon is-small"><i class="fas fa-lock"></i></span>
                      <span>Безопасность</span>
                    </a>
                  </li>
                </ul>
                
              </div>
                 @if(Session::has('updatePassword'))
            <div class="notification is-success">
                {{ Session::get('updatePassword') }}
            </div>
            @endif
            
             @if(Session::has('updatePasswordError'))
            <div class="notification alert-danger">
                {{ Session::get('updatePasswordError') }}
            </div>
            @endif
                
                <form action="/update-password" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
              <div class="is-clearfix"></div>
                <div class="columns is-centered">
                  <div class="column is-half">
                    <div class="field">
                      <label class="label">Текущий пароль</label>
                      <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" name="old-password">
                        <span class="icon is-small is-left">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                    </div>

                    <div class="field">
                      <label class="label">Новый пароль</label>
                      <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" name="new-password">
                        <span class="icon is-small is-left">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                    </div>

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