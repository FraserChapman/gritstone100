<?php

namespace App\Controllers;

/**
 * ErrorController
 * 
 * See ONERROR in app\config.ini
 */
class ErrorController extends AbstractController
{
    private const PAGE = "error";

    /**
     * HTTP GET {ERROR}
     *
     * @param \Base $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        $f3->caption = $f3->ERROR["code"];
        $f3->content = "partial/pre.tpl";
        $f3->data =  ($f3->DEBUG > 0) ?
            $f3->data = $f3->ERROR["text"] . "<br>" . $f3->ERROR["trace"] :
            $f3->data = $f3->ERROR["text"];
            
        switch ($f3->ERROR["code"]) {
            case 404:
                $f3->byline = "It looks like one of us is lost...";
                break;
            default:
                $f3->byline = $f3->ERROR["status"];
        }

        // NB: recursively clear existing output buffers:
        while (ob_get_level()) {
            ob_end_clean();
        }

        print_r(\Template::instance()->render(parent::TEMPLATE, parent::MIME));
    }
}
