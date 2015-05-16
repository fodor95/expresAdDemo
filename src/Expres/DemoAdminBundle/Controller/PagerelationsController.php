<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;


class PagerelationsController extends Controller
{
    public function indexAction()
    {
        $postedData = array();
        $post = Request::createFromGlobals();

        if($post -> request -> has('submit')):

            $postedData['home'] = $post -> request -> get('home');
            $postedData['features'] = $post -> request -> get('features');
            $postedData['about'] = $post -> request -> get('about');
            $postedData['contact'] = $post -> request -> get('contact');

            $this->updateMapping($postedData);

        endif;

        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents('%kernel.root_dir%/../configuration/basicconfig.yml'));
        
        $staticPages = $this->getStaticPages();
    	
        return $this->render('ExpresDemoAdminBundle:Pagerelations:index.html.twig',
            array(
                'pages' => $value,
                'pagedb' => $staticPages,
                'postedData' => $postedData,

                ));	
    }

    private function getStaticPages(){
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->findAll();
        

        return $entities;
    }

    private function updateMapping($value = array()){
        // this function updates the page relationships to the main menu

        $array = array('home' => $value['home'], 
                        'features' => $value['features'],
                        'about' => $value['about'],
                        'contact' => $value['contact']);

        $dumper = new Dumper();

        $yaml = $dumper->dump($array);
        // $yaml = $dumper->dump($array);

        file_put_contents('%kernel.root_dir%/../configuration/basicconfig.yml', $yaml);

        return true;
    }
}
