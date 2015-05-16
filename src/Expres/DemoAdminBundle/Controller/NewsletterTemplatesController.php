<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\NewsletterTemplates;
use Expres\DemoAdminBundle\Form\NewsletterTemplatesType;

/**
 * NewsletterTemplates controller.
 *
 */
class NewsletterTemplatesController extends Controller
{

    /**
     * Lists all NewsletterTemplates entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->findAll();

        return $this->render('ExpresDemoAdminBundle:NewsletterTemplates:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new NewsletterTemplates entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new NewsletterTemplates();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('administrator_newslettertemplates_show', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoAdminBundle:NewsletterTemplates:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a NewsletterTemplates entity.
     *
     * @param NewsletterTemplates $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(NewsletterTemplates $entity)
    {
        $form = $this->createForm(new NewsletterTemplatesType(), $entity, array(
            'action' => $this->generateUrl('administrator_newslettertemplates_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new NewsletterTemplates entity.
     *
     */
    public function newAction()
    {
        $entity = new NewsletterTemplates();
        $form   = $this->createCreateForm($entity);

        return $this->render('ExpresDemoAdminBundle:NewsletterTemplates:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a NewsletterTemplates entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterTemplates entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:NewsletterTemplates:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing NewsletterTemplates entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterTemplates entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:NewsletterTemplates:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a NewsletterTemplates entity.
    *
    * @param NewsletterTemplates $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NewsletterTemplates $entity)
    {
        $form = $this->createForm(new NewsletterTemplatesType(), $entity, array(
            'action' => $this->generateUrl('administrator_newslettertemplates_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing NewsletterTemplates entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterTemplates entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('administrator_newslettertemplates_edit', array('id' => $id)));
        }

        return $this->render('ExpresDemoAdminBundle:NewsletterTemplates:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a NewsletterTemplates entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsletterTemplates entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('administrator_newslettertemplates'));
    }

    /**
     * Creates a form to delete a NewsletterTemplates entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administrator_newslettertemplates_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function simpleDeleteAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->find($id);

        if(!$entity){
            throw $this->createNotFoundException('Unable to delete or find this entity');
        }
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('administrator_newslettertemplates'));
    }

}
