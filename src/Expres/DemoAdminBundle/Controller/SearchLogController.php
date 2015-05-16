<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\SearchLog;
use Expres\DemoAdminBundle\Form\SearchLogType;

/**
 * SearchLog controller.
 *
 */
class SearchLogController extends Controller
{

    /**
     * Lists all SearchLog entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoAdminBundle:SearchLog')->findAll();

        return $this->render('ExpresDemoAdminBundle:SearchLog:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SearchLog entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SearchLog();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('searchlog_show', array('id' => $entity->getId())));
        }

        return $this->render('ExpresDemoAdminBundle:SearchLog:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SearchLog entity.
     *
     * @param SearchLog $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SearchLog $entity)
    {
        $form = $this->createForm(new SearchLogType(), $entity, array(
            'action' => $this->generateUrl('searchlog_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SearchLog entity.
     *
     */
    public function newAction()
    {
        $entity = new SearchLog();
        $form   = $this->createCreateForm($entity);

        return $this->render('ExpresDemoAdminBundle:SearchLog:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SearchLog entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:SearchLog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SearchLog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:SearchLog:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SearchLog entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:SearchLog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SearchLog entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:SearchLog:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SearchLog entity.
    *
    * @param SearchLog $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SearchLog $entity)
    {
        $form = $this->createForm(new SearchLogType(), $entity, array(
            'action' => $this->generateUrl('searchlog_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SearchLog entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:SearchLog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SearchLog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('searchlog_edit', array('id' => $id)));
        }

        return $this->render('ExpresDemoAdminBundle:SearchLog:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SearchLog entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExpresDemoAdminBundle:SearchLog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SearchLog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('searchlog'));
    }

    /**
     * Creates a form to delete a SearchLog entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('searchlog_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
