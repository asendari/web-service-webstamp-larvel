<?php

namespace Asendari\WebServiceWebstamp;

use Asendari\WebServiceWebstamp\Models\WebstampOrder;
use Asendari\WebServiceWebstamp\Soap\WebstampOrderSoapClient;
use stdClass;

class Webstamp
{
    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new WebstampOrderSoapClient();
    }

    public function newOrder(WebstampOrder $order): string
    {
        return $this->getLabelContent($this->soapClient->newOrder($order));
    }

    public function getLabelContent(stdClass $response) : string
    {

        if(
            $response->new_orderResult &&
            $response->new_orderResult->print_data
        ){
            return $response->new_orderResult->print_data;
        }

        return '';
    }
}