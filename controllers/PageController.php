<?php

namespace App\Controllers;

/**
 * PageController
 */
class PageController extends AbstractController
{
    /**
     * kinderScout
     * GET /kinder-scout
     * @param  mixed $f3
     * @return void
     */
    public function kinderScout($f3)
    {
        $f3->id = "kinder-scout";
        $f3->caption = "KINDER SCOUT";
        $f3->content = '/content/kinder-scout.tpl';
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
        
    /**
     * dambusters
     * HTTP GET /dambusters
     *
     * @param  mixed $f3
     * @return void
     */
    public function dambusters($f3)
    {
        $f3->id = "dambusters";
        $f3->caption = "DAMBUSTERS";
        $f3->content = '/content/dambusters.tpl';
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }

    /**
     * edale
     * HTTP GET /edale
     * 
     * @param  mixed $f3
     * @return void
     */
    public function edale($f3)
    {
        $f3->id = "edale";
        $f3->caption = "EDALE";
        $f3->content = '/content/edale.tpl';
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
    
    /**
     * castleton
     * HTTP GET /castleton
     *
     * @param  mixed $f3
     * @return void
     */
    public function castleton($f3)
    {
        $f3->id = "castleton";
        $f3->caption = "CASTLETON";
        $f3->content = '/content/castleton.tpl';
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
    
    /**
     * wildlife
     * HTTP GET /wildlife
     *
     * @param  mixed $f3
     * @return void
     */
    public function wildlife($f3)
    {
        $f3->id = "wildlife";
        $f3->caption = "WILDLIFE";
        $f3->content = '/content/wildlife.tpl';
        
        echo \Template::instance()->render(parent::TEMPLATE, parent::MIME);
    }
}
