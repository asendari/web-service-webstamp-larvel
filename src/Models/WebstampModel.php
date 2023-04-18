<?php

namespace Asendari\WebServiceWebstamp\Models;

use Asendari\WebServiceWebstamp\Helpers\WebstampHelpers;

abstract class WebstampModel
{

    /**
     * Mame_Object constructor.
     * Loads the values of $object into $this where $object can be an object or an array.
     *
     * @param null|StdClass|array $object
     */
    public function __construct( $object = null )
    {
        if ( $object ) {
            $this->populate( $object );
        }
    }

    public function populate( $object )
    {
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        foreach ( $object as $name => $value ) {
            if ( property_exists( $this, $name ) ){
                $this->$name = $value;
            }
        }
    }

    public function to_string()
    {
        $result = '';
        $vars   = get_object_vars( $this );

        foreach ( $vars as $name => $value ) {

            if ( is_object( $value ) ) {
                continue;
            }

            if ( is_array( $value ) ) {
                $result .= $name . ': ' . json_encode( $value ) . ';';
            } else {
                $result .= $name . ': ' . $value . ';';
            }

        }

        return $result;
    }

    public function toSoap(): array
    {

        $datas = WebstampHelpers::arrayMapKey($this, function ($k) {
            return ucfirst($k);
        });
        return $datas;
    }

}