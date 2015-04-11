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


class ReliefWeb implements Crawler{

    const ENDPOINT = 'http://api.rwlabs.org/v1/disasters/11880';

    public function getEvents()
    {
        $content  = file_get_contents(self::ENDPOINT);
        return $content;
    }
}