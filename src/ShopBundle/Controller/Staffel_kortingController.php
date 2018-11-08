<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Staffel_korting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Staffel_korting controller.
 *
 * @Route("staffel_korting")
 */
class Staffel_kortingController extends Controller
{
    /**
     * Lists all staffel_korting entities.
     *
     * @Route("/", name="staffel_korting_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $staffel_kortings = $em->getRepository('ShopBundle:Staffel_korting')->findAll();

        return $this->render('staffel_korting/index.html.twig', array(
            'staffel_kortings' => $staffel_kortings,
        ));
    }


    /**
     * Finds and displays a staffel_korting entity.
     *
     * @Route("/{id}", name="staffel_korting_show")
     * @Method("GET")
     */
    public function showAction(Staffel_korting $staffel_korting)
    {
        $deleteForm = $this->createDeleteForm($staffel_korting);

        return $this->render('staffel_korting/show.html.twig', array(
            'staffel_korting' => $staffel_korting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing staffel_korting entity.
     *
     * @Route("/{id}/edit", name="staffel_korting_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Staffel_korting $staffel_korting)
    {
        $deleteForm = $this->createDeleteForm($staffel_korting);
        $editForm = $this->createForm('ShopBundle\Form\Staffel_kortingType', $staffel_korting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('staffel_korting_edit', array('id' => $staffel_korting->getId()));
        }

        return $this->render('staffel_korting/edit.html.twig', array(
            'staffel_korting' => $staffel_korting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a staffel_korting entity.
     *
     * @Route("/{id}", name="staffel_korting_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Staffel_korting $staffel_korting)
    {
        $form = $this->createDeleteForm($staffel_korting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($staffel_korting);
            $em->flush();
        }

        return $this->redirectToRoute('staffel_korting_index');
    }

    /**
     * Creates a form to delete a staffel_korting entity.
     *
     * @param Staffel_korting $staffel_korting The staffel_korting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Staffel_korting $staffel_korting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('staffel_korting_delete', array('id' => $staffel_korting->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
