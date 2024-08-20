<?php

namespace App\Controllers;

/**
 * AbstractController
 */
abstract class AbstractController
{
    protected const TEMPLATE = "page.tpl";
    protected const MIME = "text/html";
    
    function __construct()
    {
    }
}
