<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemOutStockOrExpired extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $re;
    public function __construct($re){
        $this->re = $re;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('emails.item_out_stock_expired')
            ->from(env('constants.SITE_EMAIL'), config('constants.SITE_NAME'))
            ->subject($this->re['email_subject'])
            ->with($this->re);
    }
}
