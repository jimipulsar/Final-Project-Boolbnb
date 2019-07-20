<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
     {
         return true;
     }

     /**
      * Get the validation rules that apply to the request.
      *
      * @return array
      */
     public function rules()
     {
         return [
            'title'=> 'required|string',
            'description'=> 'required|string',
            'price'=> 'required|numeric',
            'street'=> 'required|string',
            'house_number'=> 'required|numeric',
            'locality'=> 'required|string',
            'postal_code'=> 'required|numeric',
            'latitude'=> 'required|numeric',
            'longitude'=> 'required|numeric',
            'user_id'=>'exists:users,id',
            'services'=>'nullable|exists:services,name',
           'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'n_rooms' => 'required|numeric|min:1',
           'n_beds' => 'required|numeric|min:1',
           'n_baths' => 'required|numeric|min:1',
           'metri_quadrati' => 'required:integer',
           'service_id' => 'required|string',
           'published' => 'required',

           // 'credit_card_number' => 'required_if:payment_type,cc',
         ];
     }
     public function message()
     {
         return [

         ];
     }
}
