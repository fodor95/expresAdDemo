<?php

namespace Expres\DemoAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;

class WebsiteConfigurationController extends Controller
{
	public function indexAction(){


		//writing yml file

		// $array = array(
		//     'mainMenu' => array('home' => 4, 
		//     					'features' => 5,
		//     					'about' => 6,
		//     					'contact' => 8
		//     					),
		// );

		// $dumper = new Dumper();

		// $yaml = $dumper->dump($array);
		// $yaml = $dumper->dump($array);

		// file_put_contents('%kernel.root_dir%/../configuration/basicconfig.yml', $yaml);

		// writind yml file end



		//reading yml file
		$yaml = new Parser();

		$value = $yaml->parse(file_get_contents('%kernel.root_dir%/../configuration/basicconfig.yml'));
		// $value = $yaml->parse(file_get_contents('%kernel.root_dir%/../../src/Expres/DemoAdminBundle/Resources/config/routing/staticpages.yml'));

		//end reading yml file

		$value = $this->getConfiguration('mainMenu');

		// rendering the template
		return $this->render('ExpresDemoAdminBundle:WebsiteConfiguration:index.html.twig', array(
			'file' => $value
			));
	}


	public function getConfiguration($section){

		$yaml = new Parser();

		$value = $yaml->parse(file_get_contents('%kernel.root_dir%/../configuration/basicconfig.yml'));

		return $value[$section];
	}



}