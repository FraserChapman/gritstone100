<?php

namespace App\Controllers;

/**
 * LntController
 */
class LntController  extends AbstractController
{
    private const PAGE = 'lnt';

    /**
     * HTTP GET /lnt
     *
     * @param  mixed $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        $f3->caption = 'LEAVE NO TRACE';
        $f3->content = '/content/lnt.tpl';
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
}
