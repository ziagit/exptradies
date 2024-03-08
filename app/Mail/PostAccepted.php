<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostAccepted extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $post;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$post)
    {
        $this->name = $name;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build()
    {
         return $this->from('support@exptradies.com','Exptradies')
         ->subject("Quotation Accepted for Job Opportunity - ".$this->post->service->name)
         ->with([
             'name'=>$this->name,
             'title'=>$this->post->service->name,
             ])
         ->view('mails.post_accepted');
    }
}
