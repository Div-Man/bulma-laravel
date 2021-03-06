@extends('layouts/app')
@section('content')
<section class="hero is-warning">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Новые события - новые фотографии!
            </h1>
            <h2 class="subtitle">
                Заполните форму и пополните вашу галерею.
            </h2>
        </div>
    </div>
</section>
<div class="container main-content">

    <div class="columns">
        <div class="column"></div>
        <div class="column is-quarter auth-form">
            <form action="/store-image" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="field">
                     @if ($errors->has('title'))
                    <span style="color: red; font-weight: bold;">{{$errors->first('title')}}</span>
                 @endif
                    <label class="label">Название</label>
                    <div class="control">
                        <input class="input" name="title" value="{{ old('title') }}" type="text"> 
                    </div>
                </div>

                <div class="field">
                     @if ($errors->has('description'))
                    <span style="color: red; font-weight: bold;">{{$errors->first('description')}}</span>
                 @endif
                    <label class="label">Краткое описание</label>
                    <div class="control">
                        <textarea name="description" class="textarea">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="field">
                    @if ($errors->has('choose-category'))
                    <span style="color: red; font-weight: bold;">{{$errors->first('choose-category')}}</span>
                 @endif
                    <label class="label">Выберите категории</label>
                    <div class="control">
                       
                            <select  multiple="multiple"  id="my-select" name="choose-category[]">                    
                                @foreach($subCategory as $category2) 
                                  <option value="{{$category2->id}}">{{$category2->sub_category_name}}</option>
                                @endforeach
                           </select>

                    </div>
                     <script src="/js/jquery.select-multiple.js" type="text/javascript"></script>
                    <script>
                        $('#my-select').selectMultiple()
                    </script>
                </div>
                
                <div class="field">
                     @if ($errors->has('image'))
                    <span style="color: red; font-weight: bold;">{{$errors->first('image')}}</span>
                 @endif
                    <label class="label">Выберите картинку</label>
                    <div class="file is-normal has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" name="image">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Выбрать файл
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
              

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-success is-large">Загрузить</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="column"></div>
    </div>
</div>
@endsection