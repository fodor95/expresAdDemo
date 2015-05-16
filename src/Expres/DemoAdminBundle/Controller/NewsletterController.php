<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Expres\DemoAdminBundle\Entity\NewsletterTemplates;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \DateTime;

use Expres\DemoAdminBundle\Models\Document;

class NewsletterController extends Controller
{
    public function subscribersAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExpresDemoBundle:Newsletter')->findAll();

        return $this->render('ExpresDemoAdminBundle:Newsletter:subscribers.html.twig', array(
            'entities' => $entities));
    }


    public function deleteAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ExpresDemoBundle:Newsletter')->find($id);

    	if(!$entity){
    		throw $this->createNotFoundException('Unable to delete or find this entity');
    	}
    	$em->remove($entity);
    	$em->flush();

    	return $this->redirect($this->generateUrl('newsletter_subscribers'));
    }

    public function newslettersenderAction($template){

        $newsletter = $this->getNewsletterTemplate($template);

        return $this->render('ExpresDemoAdminBundle:Newsletter:newsletterSender.html.twig',
            array('templateId'=>$template,
                    'template'=>$newsletter
                ) );
    }

    private function getNewsletterTemplate($id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ExpresDemoAdminBundle:NewsletterTemplates')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterTemplates entity.');
        }

        return $entity;
    }

    public function newslettersendAction(){
        $post = Request::createFromGlobals();
        
        $entity['subject'] = 'a';
        $entity['extrareceivers'] = 'a';
        $entity['message'] = 'a';
        $entity['img'] = '';

        if($post -> request -> has('submit')):

            $entity['subject'] = $post -> request -> get('subject');
            $entity['extrareceivers'] = $post -> request -> get('extraTo');
            $entity['message'] = $post -> request -> get('message');

            // $img = $post->files->get('img');
            
            // if($img instanceof UploadedFile):
            //     $entity['img'] = $img -> getSize() / 1024*1024;

            //     $document = new Document();

            //     $document->setFile($img);
                

            //     $document->setSubDirectory('uploads');

            //     $document->processFile();

            //     $uploadedURL=$uploadedURL = $document->getUploadDirectory() . DIRECTORY_SEPARATOR . $document->getSubDirectory() . DIRECTORY_SEPARATOR . $img->getBasename();

            //     $entity['img'] = $uploadedURL;
            // endif;

            




            $databaseEmails = $this->stripEmails();
            $extraEmails = explode(';', $entity['extrareceivers']);

            $this->sendToUsers($databaseEmails, $extraEmails ,$entity['subject'],$entity['message'],'attachemnt');
            
        endif;



        return $this->render('ExpresDemoAdminBundle:Newsletter:newsletterSent.html.twig',
            array('entity'=>$entity,
                    'users'=>$databaseEmails
                ) );
    }


    private function sendToUsers($users,$extra,$subject,$content,$attachment = null){

        foreach ($users as $number => $email):
            if($email != '') 
                $this->emailSending($email,$subject,$content,$attachment);
        endforeach;


        foreach ($extra as $number => $email) {
            if($email != '') 
                $this->emailSending($email,$subject,$content,$attachment);
        }
    }

    private function emailSending($email,$subject,$content,$attachments = null){
        // ORIGINAL APP
        // $mailer = $this->get('mailer');

        // $message = $mailer->createMessage()
        //     ->setSubject($subject)
        //     ->setFrom('iwdesign88@gmail.com')
        //     ->setTo($email)
        //     ->setBody($content,'text/html');
        

        // $mailer->send($message);



        /*SHITTY*/
        // $message = Swift_Message::newInstance()
        //     ->setSubject('Hello Email')
        //     ->setFrom('iwdesign88@gmail.com')
        //     ->setTo('tanget199@yahoo.com')
        //     ->setBody('alma')
        //     ;

        // $this->get('swiftmailer.mailer')->send($message);

        // THE REVEWED SCRIPT

        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()

        ->setSubject('You have Completed Registration!')
        ->setFrom('send@example.com')
        ->setTo('recipient@example.com')
        ->setBody('AMA','text/html');

         $mailer->send($message);
          
    }

    private function getUserEmails(){
        // some kind of db shit to do,

        // then

        // return $the array with the email adress of the subscribers

        $repository = $this->getDoctrine()->getRepository('ExpresDemoBundle:Newsletter');

        $query = $repository->createQueryBuilder('p')
                    ->select('p.email')
                    ->getQuery();

        $entity = $query ->getResult();

        return $entity;
    }

    private function stripEmails(){

        $emails = $this->getUserEmails();
        $return = '';

        foreach ($emails as $email => $value) {
            foreach ($value as $key => $emi) {
                $return .= $emi . ';';
            }
        }

        $array = explode(';', $return);

        return $array;
    }

    private function attachementUpload($img){

        $request = Request::createFromGlobals();
        $uploadedURL = 'nintsen';
        
        // check if there was a submit button
        if(($request->getMethod() == 'POST') && ($request -> request -> has('submit'))){
            // it was submitted a form

            $alma = 'volt feltoltes geco maco';
            $alma = $request->files->get('img');
            // $image = $request->files->get('img');
            $alma .= '<br>';
            

            if(($image instanceof UploadedFile) && ($image->getError() == '0')){
                // if there was a submitted form now comes the file validation
                    
                    // gets the size of the uploaded file
                    $alma .= 'File size: ';
                $alma .= $image -> getSize() / 1024*1024; 

                    // gets the original file name
                    $alma .='<br> Original name: ';
                $alma .= $image ->getClientOriginalName();

                    // get the extension 
                $name_array = explode('.', $image->getClientOriginalName());
                    $alma .= '<br>Original extension: ';
                                
                $alma .= $name_array[sizeof($name_array)-1];

                    //check if it is a valid file, or the extension is valid
                $valid_filetypes = array('jpg','jpeg','bmp','png');


                if(in_array(strtolower($name_array[sizeof($name_array)-1]), $valid_filetypes)){
                    $alma .= 'the filetype is valid';
                    // IF EVERYTHING IS OK, 
                }
                else{ $alma .= 'the file type is not valid'; }

                    // get the mime type
                $alma .= '<br>' . $image->getClientMimeType();
                
                    // check if the file is valid
                $alma .= '<br>' . $image->isValid();

                    // then start uploading

                $document = new Document();

                $document->setFile($image);
                

                $document->setSubDirectory('uploads');

                $document->processFile();

                $uploadedURL=$uploadedURL = $document->getUploadDirectory() . DIRECTORY_SEPARATOR . $document->getSubDirectory() . DIRECTORY_SEPARATOR . $image->getBasename();

                                
                $alma .= '<br>' . $uploadedURL;
            }


        }else{
            // it was not submitted a form
            $alma = 1;
        }


        return $uploadedURL;
    }

}
