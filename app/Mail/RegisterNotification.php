<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// 新規登録時に送られるメール

class RegisterNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $gender;
    public $email;
    public $salon_name;
    public $salon_address;
    public $salon_tel;

    public function __construct($name,$gender,$email,$salon_name,$salon_address,$salon_tel)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->email = $email;
        $this->salon_name = $salon_name;
        $this->salon_address = $salon_address;
        $this->salon_tel = $salon_tel;
    }

    public function build()
    {
        return $this->subject('新規登録完了のお知らせ')
                    ->view('auth.register_notification')
                    ->subject('新規登録完了のお知らせ')
                    ->with([
                        'name' => $this->name,
                        'gender' => $this->gender,
                        'email' => $this->email,
                        'salon_name' => $this->salon_name,
                        'salon_address' => $this->salon_address,
                        'salon_tel' => $this->salon_tel,
                    ]);
    }
}
