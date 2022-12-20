<?php

namespace Alfred\MvcProject\Controllers;

class HomePageController
{
    public function renderHomePage(): string
    {
        return '<h1>Welcome to our Home Page :)</h1>';
    }

    public function renderNotFoundPage(): string
    {
        return '<h1>Page Not Found :) </h1>';
    }
}