<?php

namespace Frontend\Controllers;

use Core\Controller;

final class SiteController extends Controller
{
    public function __construct()
    {
        $path = dirname(__DIR__,1).'/views';
        parent::__construct($path);
    }

    public function getIndex()
    {
        $data['name'] = "Ласкаво просимо";
        return $this->render('site/index.phtml', $data);
    }
    public function getContacts()
    {
        $data['name'] = "Контакты";
        return $this->render('site/page.phtml', $data);
    }
    public function getAbout()
    {
        $data['name'] = "Про нас";
        return $this->render('site/page.phtml', $data);
    }
    public function getDelivery()
    {
        $data['name'] = "Про нас";
        return $this->render('site/page.phtml', $data);
    }
}