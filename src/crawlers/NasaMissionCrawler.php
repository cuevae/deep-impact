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
 * NasaLaunchSchedule.php
 */

namespace DeepImpact\Crawlers;

use DOMDocument;

class NasaMissionCrawler implements Crawler
{

    const ENDPOINT = 'http://www.nasa.gov/missions/schedule/';

    public function getEvents()
    {
        $html = file_get_contents(self::ENDPOINT);

        $doc = new DOMDocument;
        $doc->preserveWhiteSpace = FALSE;
        @$doc->loadHTML($html);
    }
}