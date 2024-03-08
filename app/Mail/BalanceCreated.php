<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BalanceCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $balance;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $balance)
    {
        $this->name = $name;
        $this->balance=$balance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@exptradies.com')
        ->subject('Balance created')
        ->with([
            'name'=> $this->name,
            'balance'=>$this->balance])
        ->view('mails.balance_created');
    }
}
