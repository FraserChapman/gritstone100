<?php

namespace App\Controllers;

use App\Helpers;

/**
 * MapController
 */
class MapController extends AbstractController
{
    private const PAGE = "map";

    /**
     * HTTP GET /map
     *
     * @param  mixed $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        $f3->caption = strtoupper(self::PAGE);
        $f3->head = "/partial/map-head.tpl";
        $f3->content = "/content/map.tpl";
        $f3->geojson = Helpers::getJson("assets/geojson/gs100.min.geojson");

        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
}
