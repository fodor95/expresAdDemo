<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Expres\DemoAdminBundle\Entity\pfpTask;
use Expres\DemoAdminBundle\Form\pfpTaskType;


/**
 * StaticPages controller.
 * HORIZONt TAXI +44 77 21 64 04 76 
 */
class PainFreePlannerController extends Controller
{
	public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->findAll();

    	return $this->render('ExpresDemoAdminBundle:PainFreePlanner:index.html.twig', array('task' => $entities));
    }


    public function createAction(Request $request)
    {
        // $entity = new pfpTask();
        // $form = $this->createCreateForm($entity);
        // $form->handleRequest($request);

        // if ($form->isValid()) {
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($entity);
        //     $em->flush();

        //     return $this->redirect($this->generateUrl('pfptask'));
        // }

        // return $this->render('ExpresDemoAdminBundle:PainFreePlanner:new.html.twig', array(
        //     'entity' => $entity,
        //     'form'   => $form->createView(),
        // ));
        $post = Request::createFromGlobals();
        if($post -> request -> has('submit')):
            
            $task = new pfpTask();
            $task->setCreated(new \DateTime('now'));
            $task->setName($post -> request -> get('name'));
            $task->setShortDescribtion($post -> request -> get('shortDescribtion'));
            $task->setHeader($post -> request -> get('header'));

            $task->setProgress($post -> request -> get('progress'));
            $task->setProjectID(0);
            $task->setStateID(0);
            $task->setPlace(0);
    
    // $post -> request -> get('search')

            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush();
            echo 'alma';

            

        endif;

        // die();
        return $this->redirect($this->generateUrl('pfptask'));
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

        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:new.html.twig', array(
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
        // working but not used

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pfpTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:show.html.twig', array(
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
        // not used

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pfpTask entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:edit.html.twig', array(
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
        // not used
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
        // not used

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

        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:edit.html.twig', array(
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
        // not used


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
        // not used - 
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfptask_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    public function progressAction($id, $value){
        // changes the progress of one task

        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }


        if($product->getProgress()+$value >= 100):
            $product->setProgress(100);
        elseif($product->getProgress()+$value <= 0):
            $product->setProgress(0);
        else:
            $product->setProgress($product->getProgress()+$value);
        endif;

        
        $em->flush();
        
        // var_dump($product);
        // echo '<hr>';
        // echo $product->getProgress();

        return $this->redirect($this->generateUrl('pfptask'));
    }

    public function stageAction($id, $value){
        // CHANGES THE STAGE OF ONE TASK
        // echo $id . '.-.' . $value;

        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('ExpresDemoAdminBundle:pfpTask')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setStateID($value);
        $em->flush();

        return $this->redirect($this->generateUrl('pfptask'));

    }

    public function taskBoxAction($entity, $class){
        // just only renders a view

        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:taskbox.html.twig', array('entity'=> $entity,'class'=>$class));
    }

    public function deleteTaskModalAction($id){
        // deleting a task
        // under dev.
        echo 'delete : ' . $id;
        die();
    }

    public function modositAction($id){
        // modificating - editing a task
        // under development
        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:edit2.html.twig', array('entity'=> $id));
    }

    public function logAction($year = null, $month = null){
        // this is the front controller for PFP log view, the big calendar thing


        // checks the current year and month if both are null
        if(($year == null)&&($month == null)){
            $year = $this->getCurrentYear();
            $month = $this->getCurrentMonth();
            return $this->redirectToRoute('pfptask_log_by_date', array('year'=>$year,'month'=>$month), 301);
        }

        // echo $year;
        // echo $month . '<br>';



        for($i = 0; $i < 42; $i ++)
            $monthDays[$i] = 0;

        $d = 1;
        // there must be an array, which holds when does the month start
        for($i = $this->countWhenToStartMonth($year,$month); $i < $this->countWhenToStartMonth($year,$month)+31; $i++){
            $monthDays[$i] = $d++;
            
        }


        // echo 'current month length: '.$this->getCurrentMonthLength($year,$month) . '|';

        // echo '<->';


        // echo 'day name of first day of month ('.$month.')' .$this->getDayNameOfFirstDayOfMonth($year,$month). '|';
        // echo '<->';
        // echo $this->countWhenToStartMonth($year,$month). '|';

        return $this->render('ExpresDemoAdminBundle:PainFreePlanner:logfront.html.twig', array(
                                                                                        'daysOfMonth'   => $monthDays,
                                                                                        'thisYear'      =>$year,
                                                                                        'thisMonth'     =>$month
                                                                                        ));
    }

    private function getCurrentMonthLength($year,$month){
        //RETURNS THE LAST DAY OF THE MONTH / - OR HOW LONG IS IT
        // for current month
        
        // debugging
        // echo 'getCurrentMonthLength: ' . date('d', strtotime('last day of this month'));

        return date('d', strtotime('last day of this month'));
    }

    private function getDayNameOfFirstDayOfMonth($year,$month){
        // returns the name of the day on which is the months first day (ex: 1st - is on tuesday)

        

        return date('l', strtotime($year . '-' . $month . '-1'));
        // return 'Monday';

        

    }

    private function countWhenToStartMonth($year,$month){

        $dayNamesToNumber =[
                                    'Monday'   => 0,
                                    'Tuesday'  => 1,
                                    'Wednesday'  => 2,
                                    'Thursday' => 3,
                                    'Friday'   => 4,
                                    'Saturday'   => 5,
                                    'Sunday'   => 6,
                                        ];


        $dayStart = $this->getDayNameOfFirstDayOfMonth($year,$month);

        $whereToStartLoop = $dayNamesToNumber[$dayStart];

        return $whereToStartLoop;

    }

    private function getCurrentYear(){
        // returns the current year
        return date('Y', strtotime('today'));
    }

    private function getCurrentMonth(){
        // returns the current month 
        return date('F', strtotime('today'));
    }


}