<?php

namespace App\Controllers;

/**
 * HomeController
 */
class HomeController extends AbstractController
{
    private const PAGE = "home";
        
    /**
     * HTTP GET /
     *
     * @param  mixed $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        
        print_r(\Template::instance()->render(parent::TEMPLATE, parent::MIME));
    }
}
