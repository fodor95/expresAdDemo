<?php

namespace Expres\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\SearchLog;
use \DateTime;

class SearchController extends Controller
{

    public function indexAction()
    {
        $entity = '';
        $post = Request::createFromGlobals();
        if($post -> request -> has('submit')):
            // $keyword = $post->request->get('search') . ' length of the string: '  . strlen($post->request->get('search') );
            // DEPRECATED, PERESENT IN A METHOD
            // check if the search string is too long
            // if(strlen($post->request->get('search')) > 20 ):
            //     $this->get('session')->getFlashBag()->add('error', 
            //             'You entered a too long search query. Maximum 20 characters allowed.');
            //     $keyword = null;
            
            // elseif(strlen($post->request->get('search')) < 3):
            //     $keyword = $post->request->get('search');
            //     $this->get('session')->getFlashBag()->add('error', 
            //             'You entered a too short search query. Minimum 3 characters allowed.');
            //     $keyword = null;
            // endif;
            // END OF DEPRECATED FUNCTIONS
            $keyword = $this -> checkQueryLength($post -> request -> get('search'));
        else:
            $keyword = $keyword = $this -> checkQueryLength(null);
        endif;

        if($keyword != null ):
            // IF EVERYTHING IS OK WITH THE KEYWORD THAN WE DO THE SEARCH PART
            $entity = $this->getDatabaseEntity($keyword);
            

        endif;
        
        $categoriesForSearch = $this->getCategorieNames();

        $this -> logSearchKeyword($keyword);


        return $this->render('ExpresDemoBundle:Static:search.html.twig', array(
                    'keyword'=>$keyword,
                    'entities' => $entity,
                    'categories' => $categoriesForSearch
                    ) );
    }

    private function checkQueryLength($keyword){

        if( (strlen($keyword) > 20) && ($keyword != null) ):
                $this->get('session')->getFlashBag()->add('error', 
                        'You entered a too long search query. Maximum 20 characters allowed.');
                $keyword = null;
            
        elseif( (strlen($keyword) < 3) && ($keyword != null)):
        
                $this->get('session')->getFlashBag()->add('error', 
                        'You entered a too short search query. Minimum 3 characters allowed.');
                $keyword = null;
        elseif( $keyword == null):
            $this->get('session')->getFlashBag()->add('error', 
                        'An empty query was passed.');
            $keyword = null;
        endif;

        return $keyword;
    }

    private function getDatabaseEntity($keyword){

        $repository = $this->getDoctrine()->getRepository('ExpresDemoAdminBundle:BlogPosts');
        



        $query = $repository->createQueryBuilder('p')
                    ->select()
                    ->where('p.content like :title or p.title like :content')
                    ->setParameter('title', '%'.$keyword.'%')
                    ->setParameter('content', '%'.$keyword.'%')
                    ->setFirstResult(0)
                    ->setMaxResults(50)
                    ->getQuery();

        $entity = $query ->getResult();


        // $em = $this->getDoctrine()->getManager();
        // $entity = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->findAll();
        

        return $entity;
    }
    
    // DEPRECATED METHOD
    // private function searchInEntity($entity){
    //     $result = 1;

    //     foreach ($entity as $name => $value) {
            
    //         // $result = $value;
    //                 $result++;
            
    //         foreach ($value as $name => $data) { 
    //              // $result = $name; 
                
                
    //         }
    //     }

    //     return $result;
    // }

    private function getCategorieNames(){
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->findAll();

        return $categories;
    }


    private function logSearchKeyword($keyword){

        

        $keywordSplitted = explode(' ', $keyword);

        foreach ($keywordSplitted as $key => $value) {
            
            if ($value != null)
                $this->insertIntoSearchLog($value);
        }

    }


    private function getUserIp(){
        /*
        $externalContent = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: ([\[\]:.[0-9a-fA-F]+)</', $externalContent, $m);
    */
        return  $_SERVER['REMOTE_ADDR'];
    }

    private function getUserAgent(){
        $agent = get_browser(null, true);

        return $agent['platform'] . '-' . $agent['browser'];
    }

    private function insertIntoSearchLog($keyword){
        
        $searchLog = new SearchLog();
        $searchLog -> setKeyword($keyword)
                    -> setIp( $this->getUserIp() )
                    -> setBrowser( '-' )
                    -> setDate(new DateTime('now'));

        $em = $this->getDoctrine()->getManager();
        $em -> persist($searchLog);

        $em -> flush();
    }
}
