<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\StaticPages;
use Expres\DemoAdminBundle\Form\StaticPagesType;

/**
 * StaticPages controller.
 * HORIZONt TAXI +44 77 21 64 04 76 
 */
class StaticPagesController extends Controller
{

    /**
     * Lists all StaticPages entities.    
     */
    public function indexAction($page = null)
    {
        //ENTITIES PER PAGE
        //$entitiesPerPage = 100;

        // SYMFONY DEFAULT DOCTRINE
         $em = $this->getDoctrine()->getManager();
         $entities = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->findAll(10);
        
        // $em = $this->getDoctrine()->getManager();
        

        // CUSTOM MYSQL QUERIES VAR 1 - NOT WORKING YET
        // $connection = $this ->get("database_connection");
        // $get_info = $connection->fetchColumn("SELECT * FROM staticPages");

        // NEW CUSTOM MYSQL QUERIES VAR 2 - THE GOOD WAY
        
        // IF THERE IS NO PAGE DEFINED

       // $repository = $this->getDoctrine()->getRepository('ExpresDemoAdminBundle:StaticPages');



        // IN ANY CASE, WE HAVE TO KNOW THE TABLE ENTRIES
        // $entries =  $this->countTableEntriesAction('ExpresDemoAdminBundle:StaticPages');

        // if($page == null):
        //     /**
        //      * This the case when there is no page defined, so the first 10 elements are displayed
        //      *
        //      */
        //     $query = $repository->createQueryBuilder('noRoute')
        //             ->select('noRoute.id','noRoute.title','noRoute.content')
                    
        //             ->orderBy('noRoute.id','ASC')
        //             ->setFirstResult(0)
        //             ->setMaxResults(100)
        //             ->getQuery();

        // else:
        //     /**
        //      * When there is a page defined, we have to look up first, if there is a possible page like that.
        //      *
        //      */

        //     //check the entries in the table
            

        //     //check the maximum page numbers in our table
        //     $maxNumberOfPages = $this ->getPageNumbers($entries, $entitiesPerPage);

        //     //check if the given value to the controller is a possible page number,
        //     //if not, throw a new error page
        //     if($page > $maxNumberOfPages):

        //         throw $this->createNotFoundException('This page does not exists, try an other page');

        //     else:
        //         //there is no page number is <0, than throw an exception
        //         if($page - 1 < 0) 
        //             throw $this->createNotFoundException('This page does not exists, try an other page');
        //         else
        //             $page--;

        //         $query = $repository->createQueryBuilder('noRoute')
        //             ->select('noRoute.id','noRoute.title','noRoute.content')
        //             // ->where('t.id = 20')
        //             ->orderBy('noRoute.id','ASC')
        //             ->setFirstResult($entitiesPerPage*$page) // 10 * 0 ; 10 * 1 ; 10 * 2 ; 
        //             ->setMaxResults($entitiesPerPage)
        //             ->getQuery();

        //     endif;

        // endif;


       // $entity = $query ->getResult();

      // $maxNumberOfPages = $this ->getPageNumbers($entries, $entitiesPerPage);
      

        return $this->render('ExpresDemoAdminBundle:StaticPages:index.html.twig', array(
            'entities' => $entities,
        ));
    }
  
     /**
     * Counts the elements in a table
     *
     */
    public function countTableEntriesAction($table)
    {
        $repository = $this->getDoctrine()->getRepository($table);
        
        $query = $repository->createQueryBuilder('t')
                    ->select('count(t.id)')
                    ->getQuery();

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

    /** 
     * Set starter item in pagination
     * ---->DEPRECATED<-------------
     */



    /**
     * Creates a new StaticPages entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new StaticPages();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('staticpages_show', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoAdminBundle:StaticPages:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a StaticPages entity.
     *
     * @param StaticPages $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(StaticPages $entity)
    {
        $form = $this->createForm(new StaticPagesType(), $entity, array(
            'action' => $this->generateUrl('staticpages_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new StaticPages entity.
     *
     */
    public function newAction()
    {
        $entity = new StaticPages();
        $form   = $this->createCreateForm($entity);

        return $this->render('ExpresDemoAdminBundle:StaticPages:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StaticPages entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StaticPages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:StaticPages:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing StaticPages entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StaticPages entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:StaticPages:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a StaticPages entity.
    *
    * @param StaticPages $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StaticPages $entity)
    {
        $form = $this->createForm(new StaticPagesType(), $entity, array(
            'action' => $this->generateUrl('staticpages_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing StaticPages entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StaticPages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('staticpages_edit', array('id' => $id)));
        }

        return $this->render('ExpresDemoAdminBundle:StaticPages:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a StaticPages entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StaticPages entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('staticpages'));
    }

    /**
     * Creates a form to delete a StaticPages entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('staticpages_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    public function simpleDeleteAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ExpresDemoAdminBundle:StaticPages')->find($id);

        if(!$entity){
            throw $this->createNotFoundException('Unable to delete or find this entity');
        }
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('staticpages'));
    }
}
