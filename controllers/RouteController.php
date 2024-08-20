<?php

namespace App\Controllers;

/**
 * RouteController
 */
class RouteController extends AbstractController
{
    private const PAGE = "route";

    /**
     * HTTP GET /route
     *
     * @param  mixed $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        $f3->caption = strtoupper(self::PAGE);
        $f3->content = "content/route.tpl";
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
}
