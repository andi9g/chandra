<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        // dd($this->mailData);
        return $this->subject($this->mailData['title'])
                    ->view('emails.sample_email') // Nama view template
                    ->with([
                        'title' => $this->mailData['title'],
                        'content' => $this->mailData['content'],
                        'email' => $this->mailData['email'],
                        'invoice_number' => $this->mailData['invoice_number'],
                        'total_payment' => $this->mailData['total_payment'],
                        'accomodation' => $this->mailData['accomodation'],
                        'vessel' => $this->mailData['vessel'],
                        'datestart' => $this->mailData['datestart'],
                        'dateend' => $this->mailData['dateend'],
                        'link' => $this->mailData['link'],
                    ]);
    }
}