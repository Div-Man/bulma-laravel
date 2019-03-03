<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Youtube implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            
            $parseUrlArray = parse_url($value);
            
            if(!isset($parseUrlArray['scheme']) ||
               !isset($parseUrlArray['host']) ||
               !isset($parseUrlArray['path']) 
            ){
                return false;
            }
            
            if($parseUrlArray['scheme'] != 'https' ||
               $parseUrlArray['host'] != 'www.youtube.com' ||
               $parseUrlArray['path'] != '/watch' ||
                empty($parseUrlArray['query'])
                ){ 
                    return false;
                }
                
                 $urlVideo = explode('=', $parseUrlArray['query']);
                 
                 if(empty($urlVideo['1'])) {
                     return false;
                 }
                return true;
        } 
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
         return 'Вы ввели не тот адрес';
    }
}
