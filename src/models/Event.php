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
 * Event.php
 */

namespace DeepImpact\Models;

class Event
{

    public $type;

    public $title;

    public $description;

    public $pubDate;

    public $link;

    public $img;

    public function __construct($type, $title, $description, $pubDate, $link, $img, Location $location)
    {
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->pubDate = $pubDate;
        $this->link = $link;
        $this->location = $location;
        $this->img = $img;
    }

}