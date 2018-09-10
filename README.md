# *** NO LONGER MANTAINED ***
Replaced by [Google Maps PHP SDK](https://github.com/biscolab/google-maps-php-sdk)

# Geocoder
Simple Google Maps Geocoder PHP library.
Get Latitude and Longitude of selected address in few steps!

## Installation

You can install the package via composer:
```sh
composer require biscolab/geocoder:^1.0
```

## How to use

1. Chose the address
```php
$address = 'street <YOUR_STREET>, <YOUR_CITY>, <YOUR_COUNTRY>';
```
2. Get location
```php
$loc = (new Geocoder($address))->getLocation();
```
3. Use data
`getLocation` method returns a `GeocoderLocation` object. To retrieve latitude (Lat) and longitude (Lng) use the following methods:
```php
/**
 * Return the latitude
 *
 * @return float
 */
$lat = $loc->getLat();

/**
 * Return the longitude
 *
 * @return float
 */
$lng = $loc->getLng();
```

That's it!
