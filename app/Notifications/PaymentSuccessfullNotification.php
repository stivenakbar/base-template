<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessfullNotification extends BaseDBNotification
{

    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $for ="user", protected $amount = 0)
    {   
        parent::__construct($for == "user" ?"Payment Successfull": "New Payment");
    }


    public function generateMessage():string{
        return $this->for == "user" ? "Your payment of $this->amount was successfull" : "New payment with amount: $this->amount was successfull";
    }

    public function generateCTA():string{
        return $this->for == "user" ? "dashboard/transactions" : "dashboard/transactions";
    }

}
