<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// 予約者に送る確認メール

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reservaiton;
    public $calendar;
    public $menu;

    public function __construct($user,$reservation,$calendar,$menu)
    {
        $this->user = $user;
        $this->reservation = $reservation;
        $this->calendar = $calendar;
        $this->menu = $menu;
    }

    public function build()
    {
        return $this->subject('ご予約を受け付けました')
                    ->view('reservation.reservation_confirmation')
                    ->with([  //ビューに渡すもの
                        'user' => $this->user,
                        'calendar' => $this->calendar,
                        'menu' => $this->menu,
                        'reservation' => $this->reservation,
                    ]);
    }
}
