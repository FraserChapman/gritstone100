<?php

namespace App\Controllers;

use Base;
use Template;

/**
 * AbstractController
 */
abstract class AbstractController
{
    protected const string TEMPLATE = "page.tpl";
    protected const string MIME = "text/html";

    /**
     * @param Base $f3 
     * @param array $data
     * @return void
     */
    public function render(Base $f3, array $data)
    {
        foreach ($data as $key => $value) {
            $f3->$key = $value;
        }

        echo Template::instance()->render(self::TEMPLATE, self::MIME);
    }
}
