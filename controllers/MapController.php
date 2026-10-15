<?php

namespace App\Controllers;

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
        $f3->geojson = \App\Helpers::getJson("assets/geojson/gs100.min.geojson");

        print_r(\Template::instance()->render(parent::TEMPLATE, parent::MIME));
    }
}
