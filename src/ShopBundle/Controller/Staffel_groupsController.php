<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Staffel_groups;
use ShopBundle\Entity\staffel_korting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Staffel_group controller.
 *
 * @Route("staffel_groups")
 */
class Staffel_groupsController extends Controller
{
    /**
     * Lists all staffel_group entities.
     *
     * @Route("/", name="staffel_groups_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $staffel_groups = $em->getRepository('ShopBundle:Staffel_groups')->findAll();

        return $this->render('staffel_groups/index.html.twig', array(
            'staffel_groups' => $staffel_groups,
        ));
    }

    /**
     * Creates a new staffel_group entity.
     *
     * @Route("/new", name="staffel_groups_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $staffel_group = new Staffel_groups();
        $form = $this->createForm('ShopBundle\Form\Staffel_groupsType', $staffel_group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($staffel_group);
            $em->flush();

            return $this->redirectToRoute('staffel_groups_show', array('id' => $staffel_group->getId()));
        }

        return $this->render('staffel_groups/new.html.twig', array(
            'staffel_group' => $staffel_group,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a staffel_group entity.
     *
     * @Route("/{id}", name="staffel_groups_show")
     * @Method("GET")
     */
    public function showAction(Staffel_groups $staffel_group)
    {
        $deleteForm = $this->createDeleteForm($staffel_group);

        return $this->render('staffel_groups/show.html.twig', array(
            'staffel_group' => $staffel_group,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing staffel_group entity.
     *
     * @Route("/{id}/edit", name="staffel_groups_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Staffel_groups $staffel_group)
    {
        $deleteForm = $this->createDeleteForm($staffel_group);
        $editForm = $this->createForm('ShopBundle\Form\Staffel_groupsType', $staffel_group);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('staffel_groups_edit', array('id' => $staffel_group->getId()));
        }

        return $this->render('staffel_groups/edit.html.twig', array(
            'staffel_group' => $staffel_group,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a staffel_group entity.
     *
     * @Route("/{id}", name="staffel_groups_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Staffel_groups $staffel_group)
    {
        $form = $this->createDeleteForm($staffel_group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($staffel_group);
            $em->flush();
        }

        return $this->redirectToRoute('staffel_groups_index');
    }

    /**
     * Creates a form to delete a staffel_group entity.
     *
     * @param Staffel_groups $staffel_group The staffel_group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Staffel_groups $staffel_group)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('staffel_groups_delete', array('id' => $staffel_group->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
