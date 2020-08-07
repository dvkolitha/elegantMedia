<?php

namespace App\Http\Requests\GuestRequests\GuestTicket;

use Illuminate\Foundation\Http\FormRequest;


class GuestTicketStore extends FormRequest
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

         return[
            
           'form.name' => 'required|required|regex:/^[\pL\s\-]+$/u',

           'form.problem' => 'required',

           'form.email' => 'unique:guest_tickets,email|unique:users,email|required|email',

           'form.phone_number' => 'required|numeric|digits:10',

       ];      
      
    }

}
