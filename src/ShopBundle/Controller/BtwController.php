<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Btw;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Btw controller.
 *
 * @Route("btw")
 */
class BtwController extends Controller
{
    /**
     * Lists all btw entities.
     *
     * @Route("/", name="btw_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $btws = $em->getRepository('ShopBundle:Btw')->findAll();

        return $this->render('btw/index.html.twig', array(
            'btws' => $btws,
        ));
    }

    /**
     * Creates a new btw entity.
     *
     * @Route("/new", name="btw_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $btw = new Btw();
        $form = $this->createForm('ShopBundle\Form\BtwType', $btw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($btw);
            $em->flush();

            return $this->redirectToRoute('btw_show', array('id' => $btw->getId()));
        }

        return $this->render('btw/new.html.twig', array(
            'btw' => $btw,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a btw entity.
     *
     * @Route("/{id}", name="btw_show")
     * @Method("GET")
     */
    public function showAction(Btw $btw)
    {
        $deleteForm = $this->createDeleteForm($btw);

        return $this->render('btw/show.html.twig', array(
            'btw' => $btw,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing btw entity.
     *
     * @Route("/{id}/edit", name="btw_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Btw $btw)
    {
        $deleteForm = $this->createDeleteForm($btw);
        $editForm = $this->createForm('ShopBundle\Form\BtwType', $btw);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('btw_edit', array('id' => $btw->getId()));
        }

        return $this->render('btw/edit.html.twig', array(
            'btw' => $btw,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a btw entity.
     *
     * @Route("/{id}", name="btw_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Btw $btw)
    {
        $form = $this->createDeleteForm($btw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($btw);
            $em->flush();
        }

        return $this->redirectToRoute('btw_index');
    }

    /**
     * Creates a form to delete a btw entity.
     *
     * @param Btw $btw The btw entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Btw $btw)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('btw_delete', array('id' => $btw->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
