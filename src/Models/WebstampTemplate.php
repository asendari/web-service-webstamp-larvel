<?php

namespace Asendari\WebServiceWebstamp\Models;

class WebstampTemplate extends WebstampModel
{
    const LOAD_WC_ADDRESS_SHIPPING = 'shipping';
    const LOAD_WC_ADDRESS_BILLING  = 'billing';
    const LOAD_WC_ADDRESS_CUSTOM  = 'custom';

    public string $name;
    public string $load_wc_address;
}