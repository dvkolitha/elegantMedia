<?php

namespace App\Guest;

use Illuminate\Database\Eloquent\Model;

class GuestTicket extends Model
{
    protected $fillable = ['reference_number','name','problem','email','phone_number','is_open','new_reply'];
}
