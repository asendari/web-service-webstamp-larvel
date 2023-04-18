<?php

namespace Asendari\WebServiceWebstamp;

use Asendari\WebServiceBarcode\Models\BarcodeOrder;
use Asendari\WebServiceBarcode\Soap\BarcodeSoapClient;
use stdClass;

class Webstamp
{
    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new BarcodeSoapClient();
    }

    public function generateLabel(BarcodeOrder $generateLabel): string
    {
        return $this->getLabelContent($this->soapClient->generateLabel($generateLabel));
    }

    public function getLabelContent(stdClass $response) : string
    {

        if(
            $response->Envelope &&
            $response->Envelope->Data &&
            $response->Envelope->Data->Provider &&
            $response->Envelope->Data->Provider->Sending &&
            $response->Envelope->Data->Provider->Sending->Item &&
            $response->Envelope->Data->Provider->Sending->Item->Label
        ){
            return $response->Envelope->Data->Provider->Sending->Item->Label;
        }

        return '';
    }
}