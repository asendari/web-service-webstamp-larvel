<?php

namespace Asendari\WebServiceWebstamp\Soap;

use Asendari\WebServiceWebstamp\Models\WebstampOrder;

class WebstampOrderSoapClient extends WebstampSoapClient
{

    public function __construct()
    {
        parent::__construct();
    }

    public function newOrder( WebstampOrder $order )
    {
        return $this->sendSoapRequest( $order , [$this->client, 'new_order'] );
    }

    public function newOrderPrevious( WebstampOrder $order )
    {
        return $this->sendSoapRequest( $order , [$this->client, 'new_order_preview'] );
    }

}