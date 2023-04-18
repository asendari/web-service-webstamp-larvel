<?php

namespace Asendari\WebServiceWebstamp\Models;

class WebstampAddress extends WebstampModel
{
    public $id;
    public $organization;
    public $company_addition;
    public $title;
    public $firstname;
    public $lastname;
    public $addition;
    public $street;
    public $pobox;
    public $pobox_lang;
    public $pobox_nr;
    public $zip;
    public $city;
    public $country;
    public $reference;
    public $cash_on_delivery_amount;
    public $cash_on_delivery_esr;
    public $print_address;
}