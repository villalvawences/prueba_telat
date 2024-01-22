<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function indexU(): string
    {
        return view('usuarios/index');
    }
    public function dashboard(): string
    {
        return view('dashboard');
    }
}
