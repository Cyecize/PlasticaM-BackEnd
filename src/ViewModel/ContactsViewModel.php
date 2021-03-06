<?php


namespace App\ViewModel;


class ContactsViewModel
{
    private $email;

    private $phoneNumber;

    private $whatsapp;

    private $facebook;

    private $youtube;

    public function __construct(array $settings)
    {
        $this->email = $settings['email'];
        $this->phoneNumber = $settings['phoneNumber'];
        $this->whatsapp = $settings['whatsapp'];
        $this->facebook = $settings['facebook'];
        $this->youtube = $settings['youtube'];
    }
}