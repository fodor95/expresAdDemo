<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExpresDemoAdminBundle:Page:home.html.twig');
    }

    public function sidebarAction()
    {
        return $this->render('ExpresDemoAdminBundle:Page:sidebar.html.twig');
    }

    public function pagerelationsAction(){
    	return $this->render('ExpresDemoAdminBundle:Page:pagerelations.html.twig');	
    }
}
