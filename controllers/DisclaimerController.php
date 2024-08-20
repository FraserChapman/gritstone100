<?php

namespace App\Controllers;

/**
 * DisclaimerController
 */
class DisclaimerController  extends AbstractController
{
    private const PAGE = "disclaimer";

    /**
     * HTTP GET /disclaimer
     *
     * @param \Base $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        $f3->caption = strtoupper(self::PAGE);
        $f3->content = "content/disclaimer.tpl";
        
        print_r(\Template::instance()->render(parent::TEMPLATE, parent::MIME));
    }
}
