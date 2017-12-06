<?php

class Error404 extends Controller
{
    public function index()
    {
        // load view
        require_once APP . 'views/error/index.php';
    }
}
