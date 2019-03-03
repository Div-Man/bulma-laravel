<?php
namespace App;
use App\Rules\Youtube;

trait TrateRulesMessage {
    
    public function rulesData()
    {
         return $rules = [
           'title' => 'min:4',
           'description' => 'min:5',
           'image' => 'required|image|mimes:jpg,jpeg,png',
           'choose-category' => 'array|required'
           ];
    }
    
     public function rulesVideoData()
    {
         return $rules = [
           'title' => 'min:4',
           'description' => 'min:5',
           'url' => ['required', new Youtube],
           'choose-category' => 'array|required'
           ];
    }
    
    public function messagesData()
    {
        return $messages = [
            'title.min' => 'Название должно содержать минимум :min символа.',
            'description.min' => 'Описание должно содержать минимум :min символа.',
            'image.required' => 'Изображение загружать обязательно.',
            'image.image' => 'Вы загрузили не изображение.',
            'image.mimes' => 'Допустимые форматы: jpg, jpeg, png.',
            'choose-category.required' => 'Выберите категорию',
            'url.required' => 'Укажите адрес видео'
         ];
    }
  
}
