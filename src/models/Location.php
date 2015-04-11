<?php
/**
 * Created by Enmanuel Cueva (enmanuel@cueva-e.me) for Grassroots Africa CIC.
 *
 * License details: http://www.binpress.com/license/view/l/58a5cd37aff92919e5a22bc988d59d23
 *
 * @product: GRA Forum BackEnd
 * @package:
 * @creation_date: 11/04/15
 *
 * Location.php
 */

namespace DeepImpact\Models;

class Location
{
    public $latitude;

    public $longitude;

    public $country;

    public function __construct($latitude, $longitude, $country)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
        $this->country   = $country;
    }
}