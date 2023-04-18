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
        $identification = new stdClass();
        $identification->language = 'fr';
        $identification->userid = config('webstamp.user_id');
        $identification->password = config('webstamp.password');
        $identification->encryption_type = 'sha1';
        $this->identification            = $identification;

    }


    private function setClient (){
        $wsdl = __DIR__ . '/webstamp_v6.wsdl';

        $args = [
            'location' => config('webstamp.environement') == 'production' ? config('webstamp.url_prod'): config('webstamp.url_test'),
            'encoding'           => 'UTF-8',
            'connection_timeout' => 90,
            'compression'        => ( SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP ),
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
        $msg = sprintf( "ERROR: The Barcode Server returned Error-Code '%s' with the following message: %s", $fault->faultcode, $fault->faultstring );
        return $msg;
    }




}