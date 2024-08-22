<?php

namespace App\Controllers;

use Base;
use App\Helpers;

/**
 * PageController
 */
class PageController extends AbstractController
{

    /**
     * HTTP GET /
     * 
     * @param Base $f3
     * @return void
     */
    public function home(Base $f3)
    {
        $this->render($f3, ["id" => "home"]);
    }

    /**
     * HTTP GET /route
     * 
     * @param Base $f3
     * @return void
     */
    public function route(Base $f3)
    {
        $this->render($f3, [
            "id" => "route",
            "caption" => "ROUTE",
            "content" => "/content/route.tpl",
        ]);
    }

    /**
     * HTTP GET /map
     * 
     * @param Base $f3
     * @return void
     */
    public function map(Base $f3)
    {
        $this->render($f3, [
            "id" => "map",
            "caption" => "MAP",
            "head" => "/partial/map-head.tpl",
            "content" => "/content/map.tpl",
            "geojson" => Helpers::getJson("assets/geojson/gs100.min.geojson")
        ]);
    }

    /**
     * HTTP GET /contact
     * 
     * @param Base $f3
     * @return void
     */
    public function contact(Base $f3)
    {
        $this->render($f3, [
            "id" => "contact",
            "caption" => "CONTACT",
            "byline" => \Template::instance()->render("/partial/contact.tpl")
        ]);
    }

    /**
     * HTTP GET /lnt
     * 
     * @param Base $f3
     * @return void
     */
    public function lnt(Base $f3)
    {
        $this->render($f3, [
            "id" => "lnt",
            "caption" => "LEAVE NO TRACE",
            "content" => "/content/lnt.tpl",
        ]);
    }

    /**
     * HTTP GET /disclaimer
     * 
     * @param Base $f3
     * @return void
     */
    public function disclaimer(Base $f3)
    {
        $this->render($f3, [
            "id" => "disclaimer",
            "caption" => "DISCLAIMER",
            "content" => "/content/disclaimer.tpl",
        ]);
    }

    /**
     * GET /kinder-scout
     * 
     * @param Base $f3
     * @return void
     */
    public function kinderScout(Base $f3)
    {
        $this->render($f3, [
            "id" => "kinder-scout",
            "caption" => "KINDER SCOUT",
            "content" => "/content/kinder-scout.tpl",
        ]);
    }

    /**
     * HTTP GET /dambusters
     * 
     * @param Base $f3
     * @return void
     */
    public function dambusters(Base $f3)
    {
        $this->render($f3, [
            "id" => "dambusters",
            "caption" => "DAMBUSTERS",
            "content" => "/content/dambusters.tpl",
        ]);
    }

    /**
     * HTTP GET /edale
     * 
     * @param Base $f3
     * @return void
     */
    public function edale(Base $f3)
    {
        $this->render($f3, [
            "id" => "edale",
            "caption" => "EDALE",
            "content" => "/content/edale.tpl",
        ]);
    }

    /**
     * HTTP GET /castleton
     * 
     * @param Base $f3
     * @return void
     */
    public function castleton(Base $f3)
    {
        $this->render($f3, [
            "id" => "castleton",
            "caption" => "CASTLETON",
            "content" => "/content/castleton.tpl",
        ]);
    }

    /**
     * HTTP GET /wildlife
     * 
     * @param Base $f3
     * @return void
     */
    public function wildlife(Base $f3)
    {
        $this->render($f3, [
            "id" => "wildlife",
            "caption" => "WILDLIFE",
            "content" => "/content/wildlife.tpl",
        ]);
    }
}