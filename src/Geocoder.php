<?php

/**
 *
 * Biscolab Geocoder - Geocoder Class
 * author: Roberto Belotti - info@robertobelotti.com
 * web : robertobelotti.com, github.com/biscolab
 *
 */

namespace Biscolab\Geocoder;

use Biscolab\Geocoder\GeocoderLocation;


class Geocoder {
    
    /**
     * Google Maps Geocode Service API url
     * @var string
     */
    private $api_url = "http://maps.google.com/maps/api/geocode/json";
    
    /**
     * your own Google Maps API key
     * @var string
     * @see https://developers.google.com/maps/documentation/javascript/get-api-key
     */
    private $key = '';
    
    /**
     * Google Maps API sensor
     * @var string - true|false
     */    
    private $sensor = 'false';
    
    /**
     * Address to encode - transform in Lat/Lan
     * @var string
     */       
    private $address = '';

    /**
     * CURL response
     * @var string
     */
    private $response = null;
    
    /**
     * Geocoder constructor
     */
    public function __construct($address, $sensor = 'false')
    {
        $this->setAddress($address);
        $this->setSensor($sensor);
        $this->call();

    }

    /**
     * Set address to encode
     *
     * @param $address string
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Set sensor parameter
     *
     * @param $sensor mixed string|bool
     * accepted true|false - "true"|"false"
     */
    public function setSensor($sensor)
    {
        if($sensor === false) {
            $sensor = 'false';
        }
        $this->sensor = $sensor;
    }

    /**
     * Return the GeocoderLocation object
     *
     * @return Biscolab\Geocoder\GeocoderLocation
     */
    public function getLocation()
    {
        try {
            if(!empty($this->response['status']) && $this->response['status'] == 'OK'){
                return new GeocoderLocation($this->response['results'][0]['geometry']['location']);
            }   
        } catch (Exception $e) {
            throw new Exception("Geometry location is not defined", 1);
        }
        return false;
    }

    /**
     * Return the coomplete Google Maps API URL
     *
     * @return string
     */
    public function getUrl()
    {
        $attributes = [
            'sensor' => $this->sensor,
            'address' => $this->address,
        ];
        $query = http_build_query($attributes);
        return $this->api_url.'?'.$query;
    }

    /**
     * Perform the Google Maps API call
     *
     * @return array - decoded JSON
     */
    private function call(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->getUrl());
        $json_response = curl_exec($curl);
        curl_close($curl);

        $this->response = json_decode($json_response, true);
    }
}
