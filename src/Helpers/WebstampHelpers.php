<?php

namespace Asendari\WebServiceWebstamp\Helpers;

class WebstampHelpers
{
    public static function arrayMapKey($array, $function) {
        $result = [];
        foreach ( $array as $key => $value ) {

            $key = $function( $key );

            if( is_object( $value )) {
                $value = $value->toSoap();
            }
            if ( is_array( $value ) ) {
                $value = static::arrayMapKey( $value, $function );
            }

            $result[ $key ] = $value;

        }
        return $result;
    }
}