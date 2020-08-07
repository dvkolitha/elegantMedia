<?php

namespace App\Mail\SupportAgent;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    protected $sendTo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$sendTo)
    {
       $this->data = $data;
       $this->sendTo = $sendTo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email\ReplyMail',$this->data)->to($this->sendTo);
    }
}
