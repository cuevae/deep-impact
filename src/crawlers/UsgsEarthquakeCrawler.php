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
 * UsgsEarthquakeCrawler.php
 */

namespace DeepImpact\Crawlers;


use DeepImpact\Models\Event;
use DeepImpact\Models\Location;

class UsgsEarthquakeCrawler implements Crawler
{

    const ENDPOINT = 'http://earthquake.usgs.gov/fdsnws/event/1/query?limit={{limit}}&format=geojson';

    protected $limit;

    public function __construct($limit = 100)
    {
        $this->limit = $limit;
    }

    public function getEvents()
    {
        $events  = array();
        $content = file_get_contents(str_replace('{{limit}}', $this->limit, self::ENDPOINT));
        $data    = json_decode($content);
        foreach ($data->features as $src) {

            $a = strrpos($src->properties->place, ',') + 2;
            $t = $a - strlen($src->properties->place);
            $country = substr($src->properties->place, $t);

            $event    = new Event($src->properties->type,
                                  'Earthquake ' . $src->properties->place,
                                  'Earthquake ' . $src->properties->place,
                                  date('Y-m-d H:i:s', $src->properties->time),
                                  $src->properties->url,
                                  "http://maps.googleapis.com/maps/api/staticmap?center={$src->geometry->coordinates[0]},{$src->geometry->coordinates[1]}&zoom=7&size=400x400",
                                  new Location($src->geometry->coordinates[0],$src->geometry->coordinates[1], $country)
            );
            $events[] = $event;
        }


        return $events;

    }
}