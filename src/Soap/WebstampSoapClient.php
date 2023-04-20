<?php

namespace Asendari\WebServiceWebstamp\Soap;

use Asendari\WebServiceWebstamp\Models\WebstampOrder;
use Illuminate\Support\Facades\Log;
use SoapClient;
use SoapFault;
use stdClass;

class WebstampSoapClient
{
    public $client;
    public $identification;
    protected $debug = false;

    public function __construct()
    {
        $this->setClient();
        $this->setIdentification();

        $this->debug = config('webstamp.debug', false);
    }

    private function setIdentification()
    {
        $identification = [
            'language' => 'fr',
            'application' => config('webstamp.application_id'),
            'userid' => config('webstamp.user_id'),
            'password' => config('webstamp.password'),
            'encryption_type' => '',
        ];
        $this->identification = $identification;
    }


    private function setClient (){
        $wsdl = __DIR__ . '/webstamp_v6.wsdl';

        $environnement = config('webstamp.environement');
        if($environnement == 'production'){
            $url = config('webstamp.url_prod') . '/wsws/soap/v6'; 
        }else{
            $url = config('webstamp.url_test'). '/wsws/soap/v6';
        }

        $args = [
            'location' => $url,
            'encoding'           => 'UTF-8',
            'connection_timeout' => 90,
            'compression'        => ( SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP ),
            'trace' => 1
        ];

        if ( config('webstamp.debug', false) ) {
            $args[ 'trace' ] = true;
        }

        $this->client = new SoapClient( $wsdl, $args );

    }

    public function sendSoapRequest( $args, $func )
    {

        $request = new stdClass();

        $request->args = $args;
        $request->args->identification = $this->identification;

        try {
            $response = $func( $request );
        } catch ( SoapFault $e ) {
            $this->debug( $e );
            $response = [
                'error' => true,
                'message' => $this->formatError( $e ),
            ];
        }

        return $response;
    }

    /**
     * Prints and logs response.
     *
     * @param $response
     * @param bool $die
     */
    public function debug( $response, $die = true )
    {

        if ( $this->debug ) {

            // Show
            Log::error( print_r($response) );

            if ( $die ) {
                die();
            }
        }
    }

    public function formatError( $fault )
    {
        Log::info($this->client->__getLastResponse());
        $msg = sprintf( "ERROR: The Barcode Server returned Error-Code '%s' with the following message: %s", $fault->faultcode, $fault->faultstring );
        return $msg;
    }




}