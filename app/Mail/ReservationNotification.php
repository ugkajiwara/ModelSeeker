<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;

// 美容師に送る通知メール

class ReservationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reservaiton;
    public $calendar;
    public $menu;

    public function __construct($reservation,$calendar,$menu)
    {
        $this->reservation = $reservation;
        $this->calendar = $calendar;
        $this->menu = $menu;
    }

    public function build()
    {
        return $this->subject('新規予約通知')
                    ->view('reservation.reservation_notification')
                    ->with([
                        'calendar' => $this->calendar,
                        'menu' => $this->menu,
                        'reservation' => $this->reservation,
                    ]);
    }
}
