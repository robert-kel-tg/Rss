<?php

namespace Rss\Src;


class Twig
{
    private $twigLoaderFilesystem;

    private $twigEnvironment;

    public function __construct(\Twig_Loader_Filesystem $twigLoaderFilesystem, \Twig_Environment $twigEnvironment)
    {
        $this->twigLoaderFilesystem = $twigLoaderFilesystem;
        $this->twigEnvironment = $twigEnvironment;

        $this->twigEnvironment->setLoader($this->twigLoaderFilesystem);
    }

    public function render($name, array $context = array())
    {
        return $this->twigEnvironment->render($name, $context);
    }
}