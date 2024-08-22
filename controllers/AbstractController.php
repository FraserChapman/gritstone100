<?php

namespace App\Controllers;

use Base;
use Template;

/**
 * AbstractController
 */
abstract class AbstractController
{
    protected const TEMPLATE = "page.tpl";
    protected const MIME = "text/html";
    
    /**
     * @param Base $f3
     * @param array $data
     * @return void
     */
    function render(Base $f3, array $data)
    {
        foreach ($data as $key => $value) {
            $f3->$key = $value;
        }

        echo Template::instance()->render(self::TEMPLATE, self::MIME);
    }
}
