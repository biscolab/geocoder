<?php

/**
 *
 * Biscolab Geocoder - GeocoderLocation Class
 * author: Roberto Belotti - info@robertobelotti.com
 * web : robertobelotti.com, github.com/biscolab
 *
 */

namespace Biscolab\Geocoder;

class GeocoderLocation {

    /**
     * latitude
     *
     * @var float
     */
    private $lat = 0;

    /**
     * Longitude
     *
     * @var float
     */
    private $lng = 0;

    /**
     * GeocoderLocation constructor.
     */
    public function __construct(/* Poly */)
    {
        $args = func_get_args();

        if(count($args) == 1){
            if(!empty($args[0]['lat'])) {
                $this->lat = $args[0]['lat'];
            }
            if(!empty($args[0]['lng'])) {
                $this->lng = $args[0]['lng'];
            } 
        }
        elseif(count($args) == 2) {
            $this->lat = $args[0];
            $this->lng = $args[1];
        }
    }

    /**
     * Return the latitude
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Return the longitude
     *
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }    

}
