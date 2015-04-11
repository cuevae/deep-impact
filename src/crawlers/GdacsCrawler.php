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
 * GdacsCrawler.php
 */

namespace DeepImpact\Crawlers;

class GdacsCrawler implements Crawler
{

    const ENDPOINT = "http://www.gdacs.org/rss.aspx?profile=ARCHIVE&from=2011-04-11&to=2015-04-11&alertlevel=orange&country=&eventtype=";

    public function getEvents()
    {
        $content = file_get_contents(self::ENDPOINT);
        $x = new \SimpleXMLElement($content);

        $events = [];
        foreach($x->channel->item as $event)
        {
            $events[] = $event;
        }

        return $events;
    }
}