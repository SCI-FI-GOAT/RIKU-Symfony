<?php

namespace InterviewBundle\Controller;

use InterviewBundle\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Answer controller.
 *
 */
class AnswerController extends Controller
{
    /**
     * Lists all answer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $answers = $em->getRepository('InterviewBundle:Answer')->findAll();

        return $this->render('answer/index.html.twig', array(
            'answers' => $answers,
        ));
    }
    public function interviewAction()
    {
        return $this->render('answer/interview.html.twig');
    }

    public function getAnswersAction(){
        $em = $this->getDoctrine()->getManager();

        $answers = $em->getRepository('InterviewBundle:Answer')->findAll();


        $encoder = new JsonEncoder();

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $array = [];

        foreach ($answers as $answer){
            array_push($array,$serializer->serialize($answer, 'json'));
        }

        return new Response(implode($array));

    }

    public function sendAnswersAction(Request $request){

        $results = $request->get("answers");
        $em = $this->getDoctrine()->getManager();


        foreach ($results as $result){
            $answer = new Answer();
            $answer->setText($result["response"]);
            $question = $em->getRepository("InterviewBundle:Question")->find($result["idQuestion"]);
            $answer->setQuestion($question);
            $answer->getInterview(null);
            $em->persist($answer);
            $em->flush();
        }

        return "done";

    }

    /**
     * Creates a new answer entity.
     *
     */
    public function newAction(Request $request)
    {
        $answer = new Answer();
        $form = $this->createForm('InterviewBundle\Form\AnswerType', $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute('answer_show', array('id' => $answer->getId()));
        }

        return $this->render('answer/new.html.twig', array(
            'answer' => $answer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a answer entity.
     *
     */
    public function showAction(Answer $answer)
    {
        $deleteForm = $this->createDeleteForm($answer);

        return $this->render('answer/show.html.twig', array(
            'answer' => $answer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing answer entity.
     *
     */
    public function editAction(Request $request, Answer $answer)
    {
        $deleteForm = $this->createDeleteForm($answer);
        $editForm = $this->createForm('InterviewBundle\Form\AnswerType', $answer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('answer_edit', array('id' => $answer->getId()));
        }

        return $this->render('answer/edit.html.twig', array(
            'answer' => $answer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a answer entity.
     *
     */
    public function deleteAction(Request $request, Answer $answer)
    {
        $form = $this->createDeleteForm($answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($answer);
            $em->flush();
        }

        return $this->redirectToRoute('answer_index');
    }

    /**
     * Creates a form to delete a answer entity.
     *
     * @param Answer $answer The answer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Answer $answer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('answer_delete', array('id' => $answer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
