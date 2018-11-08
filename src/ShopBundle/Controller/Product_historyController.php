<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Product_history;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Product_history controller.
 *
 * @Route("product_history")
 */
class Product_historyController extends Controller
{
    /**
     * Lists all product_history entities.
     *
     * @Route("/", name="product_history_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product_histories = $em->getRepository('ShopBundle:Product_history')->findAll();

        return $this->render('product_history/index.html.twig', array(
            'product_histories' => $product_histories,
        ));
    }

    /**
     * Creates a new product_history entity.
     *
     * @Route("/new", name="product_history_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product_history = new Product_history();
        $form = $this->createForm('ShopBundle\Form\Product_historyType', $product_history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product_history);
            $em->flush();

            return $this->redirectToRoute('product_history_show', array('id' => $product_history->getId()));
        }

        return $this->render('product_history/new.html.twig', array(
            'product_history' => $product_history,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product_history entity.
     *
     * @Route("/{id}", name="product_history_show")
     * @Method("GET")
     */
    public function showAction(Product_history $product_history)
    {
        $deleteForm = $this->createDeleteForm($product_history);

        return $this->render('product_history/show.html.twig', array(
            'product_history' => $product_history,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product_history entity.
     *
     * @Route("/{id}/edit", name="product_history_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product_history $product_history)
    {
        $deleteForm = $this->createDeleteForm($product_history);
        $editForm = $this->createForm('ShopBundle\Form\Product_historyType', $product_history);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_history_edit', array('id' => $product_history->getId()));
        }

        return $this->render('product_history/edit.html.twig', array(
            'product_history' => $product_history,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product_history entity.
     *
     * @Route("/{id}", name="product_history_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product_history $product_history)
    {
        $form = $this->createDeleteForm($product_history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product_history);
            $em->flush();
        }

        return $this->redirectToRoute('product_history_index');
    }

    /**
     * Creates a form to delete a product_history entity.
     *
     * @param Product_history $product_history The product_history entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product_history $product_history)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_history_delete', array('id' => $product_history->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
