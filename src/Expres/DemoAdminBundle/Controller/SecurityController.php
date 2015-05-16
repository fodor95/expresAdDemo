<?php 

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
	/*
	public function loginAction(Request $request)
	{
		$session = $request->getSession();

		//get the login error if there is one
		if($request->attributes->has(SecurityController::AUTHENTICATION_ERROR)){
			$error = $request->attributes->get(
					SecurityContextInterface::AUTHENTICATION_ERROR
				);
		} elseif (null !== %session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)){
			$error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
			$session->remove(SecurityContextInterface::AUTHENTICATION_ERROR)
		} else {
			$error = '';
		}

		// last username entered by the user
		$lastUsername = (null === $session) ? '' : $session->get()
	}
	*/


	public function loginAction()
	{
	    $helper = $this->get('security.authentication_utils');

	    return $this->render('ExpresDemoAdminBundle:Security:login.html.twig', array(
	        'last_username' => $helper->getLastUsername(),
	        'error'         => $helper->getLastAuthenticationError(),
	    ));
	}


}
