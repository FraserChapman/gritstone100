<?php

namespace App\Controllers;

/**
 * ContactController
 */
class ContactController extends AbstractController
{
    private const PAGE = 'contact';
    
    /**
     * HTTP GET /contact
     *
     * @param \Base $f3
     * @return void
     */
    public function get($f3)
    {
        $f3->id = self::PAGE;
        $f3->caption = strtoupper(self::PAGE);
        $f3->byline = \Template::instance()->render('/partial/contact.tpl');
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
}
