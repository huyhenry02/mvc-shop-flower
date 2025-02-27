<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 *
 */
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public string $templateMail;
    public $subject;
    public function __construct(array $data,string $templateMail, $subject)
    {
        $this->data = $data;
        $this->templateMail = $templateMail;
        $this->subject = $subject;
    }

    public function build(): self
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($this->subject)
            ->view('mail.' . $this->templateMail)
            ->with('data', $this->data);
    }
}
