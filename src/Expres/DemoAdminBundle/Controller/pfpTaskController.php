<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\pfpTask;
use Expres\DemoAdminBundle\Form\pfpTaskType;

/**
 * pfpTask controller.
 *
 */
class pfpTaskController extends Controller
{

    /**
     * Lists all pfpTask entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->findAll();

        return $this->render('ExpresDemoAdminBundle:pfpTask:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new pfpTask entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new pfpTask();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pfptask_show', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoAdminBundle:pfpTask:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a pfpTask entity.
     *
     * @param pfpTask $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(pfpTask $entity)
    {
        $form = $this->createForm(new pfpTaskType(), $entity, array(
            'action' => $this->generateUrl('pfptask_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new pfpTask entity.
     *
     */
    public function newAction()
    {
        $entity = new pfpTask();
        $form   = $this->createCreateForm($entity);

        return $this->render('ExpresDemoAdminBundle:pfpTask:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pfpTask entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pfpTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:pfpTask:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pfpTask entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pfpTask entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:pfpTask:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a pfpTask entity.
    *
    * @param pfpTask $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(pfpTask $entity)
    {
        $form = $this->createForm(new pfpTaskType(), $entity, array(
            'action' => $this->generateUrl('pfptask_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing pfpTask entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pfpTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pfptask_edit', array('id' => $id)));
        }

        return $this->render('ExpresDemoAdminBundle:pfpTask:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a pfpTask entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find pfpTask entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pfptask'));
    }

    /**
     * Creates a form to delete a pfpTask entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfptask_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
