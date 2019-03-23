<?php

namespace OffreBundle\Controller;

use http\Client;
use OffreBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Offre controller.
 *
 */
class OffreController extends Controller
{
    /**
     * Lists all offre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offres = $em->getRepository('OffreBundle:Offre')->findAll();
        $url = "http://127.0.0.1:5000/api/compare";
        $matchings = [];

        foreach ($offres as $offre){
            $languages = preg_split ("/\,/", $offre->getLangageOffre());

            $demande = [];
            foreach ($languages as $language){
                $row = array(
                    "Specialite"=>$language,
                    "Ans"=>$offre->getExperienceOffre()
                );
                array_push($demande,$row);
            }
            $data = array(
                "demande"=>$demande,
                "url" => "http://localhost:8000/output/3.json"
            );

          // array_push($matchings,$result);

        }

        $jsonData1 = array(
            'username' => 'aaa',
            'password' => 'bbbb'
        );

        $jsonData = array(
            "demande" => array(
                array(
                    "Ans"=>1,
                    "Specialite" =>"php"
                )
            ),
            "url" => "http://localhost:8000/output/3.json"
        );
        $url1 = "http://127.0.0.1:5000/api/compare";
        $url2 = "http://127.0.0.1:5000/api/test";
       // $result = $this->CallAPI("POST", $url1, $data);

        var_dump($jsonData);
        return  new Response("eeee");


        return $this->render('offre/index.html.twig', array(
            'matchings'=> $data,
            'offres' => $offres
        ));
    }

    /**
     * Creates a new offre entity.
     *
     */
    public function newAction(Request $request)
    {
        $offre = new Offre();
        $form = $this->createForm('OffreBundle\Form\OffreType', $offre);
        $form->handleRequest($request);
          $currentUser = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $offre->setUser($currentUser);
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('offre_show', array('idOffre' => $offre->getIdoffre()));
        }

        return $this->render('offre/new.html.twig', array(
            'offre' => $offre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a offre entity.
     *
     */
    public function showAction(Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);

        return $this->render('offre/show.html.twig', array(
            'offre' => $offre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function show_detailAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Offre::class);
        $offre = $repository->find($id);
        return $this->render('offre/show_detail.html.twig', array(
            'offre' => $offre));
    }

    public function browse_jobsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offres = $em->getRepository('OffreBundle:Offre')->findAll();
        return $this->render('offre/browse_jobs.html.twig', array(
            'offres' => $offres));
    }
    /**
     * Displays a form to edit an existing offre entity.
     *
     */
    public function editAction(Request $request, Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);
        $editForm = $this->createForm('OffreBundle\Form\OffreType', $offre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_edit', array('idOffre' => $offre->getIdoffre()));
        }

        return $this->render('offre/edit.html.twig', array(
            'offre' => $offre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offre entity.
     *
     */
    public function deleteAction(Request $request, Offre $offre)
    {
        $form = $this->createDeleteForm($offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offre);
            $em->flush();
        }

        return $this->redirectToRoute('offre_index');
    }

    public function CallAPI($method, $url, $data = false)
    {
        $ch = curl_init($url);
        $jsonDataEncoded = json_encode($data);
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //Execute the request
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * Creates a form to delete a offre entity.
     *
     * @param Offre $offre The offre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offre $offre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offre_delete', array('idOffre' => $offre->getIdoffre())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
