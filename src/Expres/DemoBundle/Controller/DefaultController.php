<?php

namespace Expres\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoBundle\Entity\Newsletter;
use Expres\DemoBundle\Form\NewsletterType;
use Expres\DemoBundle\Controller\NewsletterController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;


class DefaultController extends Controller
{
    public function indexAction(){   
        $value = $this->staticPagesId('home');

        return $this->render('ExpresDemoBundle:Static:home.html.twig', array(
                'entity' => $this->getStaticPageAction($value)) );
    }

    public function aboutAction(){
        $value = $this->staticPagesId('about');

    	return $this->render('ExpresDemoBundle:Static:about.html.twig', array(
                'entity' => $this->getStaticPageAction($value)) );
    }

    public function featuresAction(){
        $value = $this->staticPagesId('features');

    	return $this->render('ExpresDemoBundle:Static:features.html.twig', array(
                'entity' => $this->getStaticPageAction($value)) );
    }

    public function contactAction(){
        $value = $this->staticPagesId('contact');

    	return $this->render('ExpresDemoBundle:Static:contact.html.twig', array(
                'entity' => $this->getStaticPageAction($value)) );
    }


    private function staticPagesId($name){

        // $yaml = new Parser();

        // $value = $yaml->parse(file_get_contents('%kernel.root_dir%/../configuration/basicconfig.yml'));
        // //end reading yml file

        $value = $this->getConfiguration();

        return $value[$name];
    }



    private function getConfiguration(){

        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents('%kernel.root_dir%/../configuration/basicconfig.yml'));

        return $value;
    }



    public function subscribeAction(Request $request){
        $entity = new Newsletter();
        $form = $this->createCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subscribe_finish', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoBundle:Newsletter:subscribe.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));

    }

    private function createCreateForm(Newsletter $entity)
    {
        $form = $this->createForm(new NewsletterType(), $entity, array(
            'action' => $this->generateUrl('subscribe'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Subscribe'));

        return $form;
    }

    public function finishSubscriptionAction(){

        // $em = $this->getDoctrine()->getManager();

        // $entity = $em->getRepository('ExpresDemoBundle:Newsletter')->find($id);

        // if (!$entity) {
        //     throw $this->createNotFoundException('Unable to find Newsletter entity.');
        // }

        $entity = 'alma';

        return $this->render('ExpresDemoBundle:Newsletter:finish.html.twig', array('entity'=>$entity));
    }

    private function getStaticPageAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find this item. Please try again later! ');
        }        

        return $entity;
    }
}
