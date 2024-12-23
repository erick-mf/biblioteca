<?php

namespace App\Controllers;

use App\Lib\Pages;

class BibliotecarioController
{
    private Pages $page;

    public function __construct()
    {
        $this->page = new Pages();
    }

    public function dashboard()
    {
        return $this->page->render(("bibliotecario/dashboard"), []);
    }
}
