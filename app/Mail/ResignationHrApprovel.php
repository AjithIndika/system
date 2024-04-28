<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class ResignationHrApprovel extends Mailable
{
    use Queueable, SerializesModels;
    public $hrmailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hrmailData)
    {
        $this->hrmailData = $hrmailData;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
           // subject: 'Resignation Hr Approvel',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
          //  view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }


     public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))->subject('RESIGNATION APPROVAL NOTIFICATION')->view('emails.resignationHRnotification');



    }
}
