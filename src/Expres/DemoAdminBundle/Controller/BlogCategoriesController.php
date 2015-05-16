<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\BlogCategories;
use Expres\DemoAdminBundle\Form\BlogCategoriesType;

/**
 * BlogCategories controller. guute nahte
 *
 */
class BlogCategoriesController extends Controller
{

    /**
     * Lists all BlogCategories entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->findAll();



        return $this->render('ExpresDemoAdminBundle:BlogCategories:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new BlogCategories entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new BlogCategories();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('blogcategories_show', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoAdminBundle:BlogCategories:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BlogCategories entity.
     *
     * @param BlogCategories $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BlogCategories $entity)
    {
        $form = $this->createForm(new BlogCategoriesType(), $entity, array(
            'action' => $this->generateUrl('blogcategories_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BlogCategories entity.
     *
     */
    public function newAction()
    {
        $entity = new BlogCategories();
        $form   = $this->createCreateForm($entity);

        return $this->render('ExpresDemoAdminBundle:BlogCategories:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BlogCategories entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogCategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:BlogCategories:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BlogCategories entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogCategories entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:BlogCategories:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BlogCategories entity.
    *
    * @param BlogCategories $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BlogCategories $entity)
    {
        $form = $this->createForm(new BlogCategoriesType(), $entity, array(
            'action' => $this->generateUrl('blogcategories_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BlogCategories entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogCategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('blogcategories_edit', array('id' => $id)));
        }

        return $this->render('ExpresDemoAdminBundle:BlogCategories:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BlogCategories entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BlogCategories entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('blogcategories'));
    }

    /**
     * Creates a form to delete a BlogCategories entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogcategories_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

        public function simpleDeleteAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogCategories')->find($id);

        if(!$entity){
            throw $this->createNotFoundException('Unable to delete or find this entity');
        }
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('blogcategories'));
    }
}
