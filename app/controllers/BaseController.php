<?php

namespace App\Controllers;

class BaseController {

    protected $templateEngine;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../Views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'debug' => true,
            //'cache' => '/path/to/compilation_cache',
            'cache' => false,
        ]);

        $this->templateEngine->addFilter(new \Twig\TwigFilter('url', function ($path){
            return BASE_URL. $path;
        }));
    }

    public function render($fileName, $data = []){
        return $this->templateEngine->render($fileName, $data);
    }
}

