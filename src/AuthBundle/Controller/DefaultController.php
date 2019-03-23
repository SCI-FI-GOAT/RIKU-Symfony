<?php

namespace AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    { $em = $this->getDoctrine()->getManager();

        $offres = $em->getRepository('OffreBundle:Offre')->findAll();

        return $this->render('AuthBundle:Default:index.html.twig', array(
            'offres' => $offres,
        ));
    }

    public function authAction(Request $request)
    {
        return new Response($request->get("code"));
    }

    public function profileAction()
    {$user = $this->getUser();
        $posterList = file_get_contents($this->get('kernel')->getRootDir() . '/../web/output/'.$user->getId().'.json');

        $json = json_decode($posterList, true);



        return $this->render('@Auth/Default/test.twig',array(
            'json' => $json,
            'posterList' => $posterList,
        ));
    }
}
