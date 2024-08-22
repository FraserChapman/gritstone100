<?php

namespace App\Controllers;

use Base;

/**
 * ErrorController
 * 
 * See ONERROR in app\config.ini
 */
class ErrorController extends AbstractController
{
    /**
     * HTTP GET {ERROR}
     *
     * @param Base $f3
     * @return void
     */
    public function get(Base $f3)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }

        $this->render($f3, [
            "id" => "error",
            "caption" => $f3->ERROR["code"],
            "content" => "partial/pre.tpl",
            "data" => ($f3->DEBUG > 0) ?
                $f3->ERROR["text"] . "<br>" . $f3->ERROR["trace"] :
                $f3->ERROR["text"],
            "byline" => ($f3->ERROR["code"] === 404) ?
                "It looks like one of us is lost..." :
                $f3->ERROR["status"]
        ]);
    }
}