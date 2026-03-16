<?php

namespace Botble\JobBoard\Mail;

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\UserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;
    public $account;

    /**
     * Create a new message instance.
     */
    public function __construct(UserNotification $notification, Account $account)
    {
        $this->notification = $notification;
        $this->account = $account;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->notification->title;
        
        return $this->subject($subject)
            ->view('plugins/job-board::emails.user-notification')
            ->with([
                'notification' => $this->notification,
                'account' => $this->account,
            ]);
    }
}
