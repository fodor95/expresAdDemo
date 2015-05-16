<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\BlogPosts;
use Expres\DemoAdminBundle\Form\BlogPostsType;

/**
 * BlogPosts controller.
 *
 */
class BlogPostsController extends Controller
{

    /**
     * Lists all BlogPosts entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->findAll();

        return $this->render('ExpresDemoAdminBundle:BlogPosts:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new BlogPosts entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new BlogPosts();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('blogposts_show', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoAdminBundle:BlogPosts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BlogPosts entity.
     *
     * @param BlogPosts $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BlogPosts $entity)
    {
        $form = $this->createForm(new BlogPostsType(), $entity, array(
            'action' => $this->generateUrl('blogposts_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BlogPosts entity.
     *
     */
    public function newAction()
    {
        $entity = new BlogPosts();
        $form   = $this->createCreateForm($entity);

        return $this->render('ExpresDemoAdminBundle:BlogPosts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BlogPosts entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPosts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:BlogPosts:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BlogPosts entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPosts entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:BlogPosts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BlogPosts entity.
    *
    * @param BlogPosts $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BlogPosts $entity)
    {
        $form = $this->createForm(new BlogPostsType(), $entity, array(
            'action' => $this->generateUrl('blogposts_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BlogPosts entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPosts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('blogposts_edit', array('id' => $id)));
        }

        return $this->render('ExpresDemoAdminBundle:BlogPosts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BlogPosts entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BlogPosts entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('blogposts'));
    }

    /**
     * Creates a form to delete a BlogPosts entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogposts_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function simpleDeleteAction($id){
        /*
         * IF THERE IS SOME KIND OF RELATIONAL DATABASE CONNECTION IT IS A MUST TO USE
         * THE "findOneBe(array())" attribute when asking for the repo
         */
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ExpresDemoAdminBundle:BlogPosts')->findOneBy(array('id'=>$id));

        if(!$entity){
            throw $this->createNotFoundException('Unable to delete or find this entity');
        }

        $em->remove($entity);
        $em->flush();

       return $this->redirect($this->generateUrl('blogposts'));
    }
}
