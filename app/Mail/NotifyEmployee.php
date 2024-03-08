<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyEmployee extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $name;
    public $location;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $title, $location)
    {
        $this->name = $name;
        $this->title = $title;
        $this->location = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@exptradies.com','Exptradies')
            ->subject("New Job Opportunity - ".$this->title)
            ->with([
                'name' => $this->name,
                'title' => $this->title,
                'location' => $this->location
                ])
            ->view('mails.notify_employee');
    }
}
