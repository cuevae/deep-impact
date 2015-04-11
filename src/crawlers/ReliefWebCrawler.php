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
 * ReliefWeb.php
 */

namespace DeepImpact\Crawlers;

use DeepImpact\Models\Event;
use DeepImpact\Models\Location;

class ReliefWebCrawler implements Crawler{

    const BASE_URL = 'http://api.rwlabs.org/v1/disasters';

    protected $limit;

    public function __construct($limit = 100)
    {
        $this->limit = $limit;
    }

    public function getEvents()
    {
        $events = array();
        $content  = json_decode(file_get_contents(self::BASE_URL . '?' . $this->limit));
        foreach($content->data as $event)
        {
            $eventData = json_decode(file_get_contents(self::BASE_URL . '/' . $event->id));
            $event = new Event($eventData->data[0]->fields->type[0]->name,
                               $eventData->data[0]->fields->name,
                               $eventData->data[0]->fields->description,
                               $eventData->data[0]->fields->date->created,
                               "http://maps.googleapis.com/maps/api/staticmap?center={$eventData->data[0]->fields->country[0]->location[1]},{$eventData->data[0]->fields->country[0]->location[0]}&zoom=7&size=400x400",
                               new Location(
                                   $eventData->data[0]->fields->country[0]->location[1],
                                   $eventData->data[0]->fields->country[0]->location[0],
                                   $eventData->data[0]->fields->country[0]->name
                               )
            );
            $events[] = $event;

        }

        return $events;
    }
}