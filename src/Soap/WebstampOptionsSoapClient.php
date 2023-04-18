<?php

namespace Asendari\WebServiceWebstamp\Soap;

use Asendari\WebServiceWebstamp\Models\WebstampOrder;
use Illuminate\Support\Facades\Log;
use SoapClient;
use SoapFault;
use stdClass;

class WebstampOptionsSoapClient extends WebstampSoapClient
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_categories'] );
    }

    public function getProducts(string $customerType = 'gk')
    {
        $args = new stdClass();
        $args->customer_type = $customerType;

        return $this->sendSoapRequest( $args , [$this->client, 'get_products'] );
    }

    public function getMediaTypes()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_media_types'] );
    }

    public function getZones()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_zones'] );
    }

    public function getCountries()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_countries'] );
    }

    public function getLicenses()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_licenses'] );
    }

    public function getProductLists()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_product_lists'] );
    }

    public function getCustomerData()
    {
        return $this->sendSoapRequest( new stdClass() , [$this->client, 'get_customer_data'] );
    }

}