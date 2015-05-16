<?php

namespace Expres\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoBundle\Entity\Newsletter;
use Expres\DemoBundle\Form\NewsletterType;

use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function indexAction($page = null,$category = null)
    {
        /* DEFAULT VARIABLES */
            $entitiesPerPage = 5;           //entries we want to show on a single page
        /* PAGINATOR LINKS */
            $paginatorOlder = '';
            $paginatorNewer = '';
            /* HELPER VARIABLES TO STORE THE ORIGINAL VALUE*/
                $paginatorPageHelper = $page;
                //$paginatorNewerHelper = '';

        /* END DEFAULT VARIABLES */
        // DEFAULT 
        // $em = $this->getDoctrine()->getManager();
        // $entities = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->findAll();
        // return $this->render('ExpresDemoBundle:Static:blog.html.twig', array('entities' => $entities,));
        // END DEFAULT
        


        $repository = $this->getDoctrine()->getRepository('ExpresDemoAdminBundle:BlogPosts');
        
        //check the number of entities in our table, in the specified category
        /**
         * $entries[int] = get the number of PAGES in the specified category, or in every category 
         * $this->countTableEntriesAction(just the name of the entity)
         */
        $entries =  $this->countTableEntriesAction('ExpresDemoAdminBundle:BlogPosts',$category);
        // END CHECKING THE ENTITIES IN A TABLE

        //check the maximum page numbers in our table, in the specified category
        /**
         * $maxNumberOfPages[int] = get the number of PAGES in the specified category, or in every category 
         * $this->getPageNumbers(entries in the table, entity # on single page, category )
         */
        $maxNumberOfPages = $this -> getPageNumbers($entries, $entitiesPerPage, $category);
        // END CHECKING THE MAXIMUM PAGE


        if($category!=null)
            $where = 'p.blogcategories = ' . $category;
        else
            $where = '1 = 1';

        if($page==null):
            $query = $repository->createQueryBuilder('p')
                        ->select()
                        ->where($where)
                        ->orderBy('p.id','DESC')
                        ->setFirstResult(0)
                        ->setMaxResults($entitiesPerPage)
                        ->getQuery();

            // BUGFIX #1 A - found on: 2015 03 06 , resolved on: 2015 03 07
            $olderPage = 2;
            $olderPage = ($olderPage > $maxNumberOfPages) ? 0 : 2; 
            $newerPage = 0;

            $paginatorPageHelper = 1;
            
        else:
            /**
             * When there is a page defined, we have to look up first, if there is a possible page like that.
             *
             */

            //check the entries in the table
            

            $olderPage = $page + 1; 
            if($olderPage > $maxNumberOfPages){
                $olderPage = 0;
                $paginatorPageHelper = 0;
            }


            $newerPage = $page - 1;

            //check if the given value to the controller is a possible page number,
            //if not, throw a new error page
            if($page > $maxNumberOfPages):

                throw $this->createNotFoundException('This page does not exists, try an other page');

            else:
                //there is no page number is <0, than throw an exception
                if($page - 1 < 0) 
                    throw $this->createNotFoundException('This page does not exists, try an other page');
                else
                    $page--;

                $query = $repository->createQueryBuilder('p')
                    ->select()
                    ->where($where)
                    ->orderBy('p.id','DESC')
                    ->setFirstResult($entitiesPerPage*$page) // 10 * 0 ; 10 * 1 ; 10 * 2 ; 
                    ->setMaxResults($entitiesPerPage)
                    ->getQuery();

            endif;
        endif;

        $entity = $query ->getResult();




        return $this->render('ExpresDemoBundle:Static:blog.html.twig', array(
            'entities' => $entity,
            'older' => $olderPage,
            'newer' => $newerPage,
            'page' => $page,
            'category' => $category
            ));
    }

    public function countTableEntriesAction($table,$category=null)
    {

        $repository = $this->getDoctrine()->getRepository($table);
        
        if($category!=null):
        
            $where = 't.blogcategories = ' . $category;
            
            $query = $repository->createQueryBuilder('t')
                        ->where($where)
                        ->select('count(t.id)')
                        ->getQuery();
        else:
            $query = $repository->createQueryBuilder('t')
                        ->select('count(t.id)')
                        ->getQuery();
        endif;

        $pagenr = $query->getSingleScalarResult();

        return $pagenr;
    }

    /**
     * Returns the number of pages 
     * This must be an integer, bigger than 1.
     *
     */
    public function getPageNumbers($entities, $itemsPerPage)
    {
        $numberOfPages = ceil($entities / $itemsPerPage);
        
        if($numberOfPages < 1)
            $numberOfPages = 1;

        return $numberOfPages;
    }



    public function singleAction($id){
    	$em = $this -> getDoctrine()->getManager();

    	$entities = $em -> getRepository('ExpresDemoAdminBundle:BlogPosts')->find($id);

    	return $this->render('ExpresDemoBundle:Static:singlePost.html.twig', array('entity' => $entities));
    }

    public function sideBarAction(){

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->findAll();
        
        $ddbug = array();

            foreach ($categories as $category => $value) {
                $ddbug[$category] = '[' . $category . '|' . $value . ']';
            }

        $number = $this->getPostNumbersInCategory('ExpresDemoAdminBundle:BlogPosts', 10);
        
        // $number = 5;
            // $ddbug = ;

    	return $this->render('ExpresDemoBundle:Static:sidebar.html.twig', array(
                'categories' => $categories,
                'number' => $number,
                'ddbug' => $ddbug,
            ));
    }

    public function blogcategoryAction($category){

    }

    public function getPostNumbersInCategory($entity, $categoryId){
        // ExpresDemoAdminBundle:BlogPosts

        $repository = $this->getDoctrine()->getRepository($entity);
        
        $query = $repository->createQueryBuilder('p')
                        ->where('p.blogcategories = ' . $categoryId)
                        ->select('count(p.id)')
                        ->getQuery();
        
        $entity = $query->getSingleScalarResult();

        return $entity;
    }


    public function countPostsAction(){
        // itten ez ugy lesz, hogy ahany item van a listaban, annyiszor meg renderelek egy uj view-t aminek van utja ish
    }

    public function getCountCategoryPostsAction($blogcategories){

        $repository = $this->getDoctrine()->getRepository('ExpresDemoAdminBundle:BlogPosts');
        
        $query = $repository->createQueryBuilder('p')
                        ->where('p.blogcategories = ' . $blogcategories)
                        ->select('count(p.id)')
                        ->getQuery();
        
        $entity = $query->getSingleScalarResult();

        return $this->render('ExpresDemoBundle:Notextending:PostCount.html.twig', array('number' => $entity));

    }

}
