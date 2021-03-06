<?php


namespace App\Service;


use App\ViewModel\ContactsViewModel;

interface ContactInfoService
{
    public function getContacts(): ContactsViewModel;
}