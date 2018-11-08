<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShopBundle\Entity\Factuur;
use ShopBundle\Entity\Artikel;
use ShopBundle\Entity\Product_history;
use AppBundle\Entity\User;

/**
 * Cart controller.
 *
 * @Route("cart")
 */
class CartController extends Controller
{
    /**
     * @Route("/", name="cart")
     */
    public function indexAction()
    {
        // get the cart from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $cart = $session->get('cart', array());

        // $cart = array_keys($cart);
        // print_r($cart); die;

        // fetch the information using query and ids in the cart
        if ($cart != '') {


            if (isset($cart)) {
                $em = $this->getDoctrine()->getEntityManager();
                $product = $em->getRepository('ShopBundle:Artikel')->findAll();
            } else {
                return $this->render('Cart/index.html.twig', array(
                    'empty' => true,
                ));
            }


            return $this->render('Cart/index.html.twig', array(
                'empty' => false,
                'product' => $product,
            ));
        } else {
            return $this->render('Cart/index.html.twig', array(
                'empty' => true,
            ));
        }
    }

    /**
     * @Route("/add/{id}", name="cart_add")
     */
    public function addAction($id)
    {
        // fetch the cart
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ShopBundle:Artikel')->find($id);
        //print_r($product->getId()); die;
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cart', array());

        // check if the $id already exists in it.
        if ($product == NULL) {
            $this->get('session')->setFlash('notice', 'This product is not     available in Stores');
            return $this->redirect($this->generateUrl('cart'));
        } else {
            if (isset($cart[$id])) {

                ++$cart[$id];
                /*  $qtyAvailable = $product->getQuantity();

                  if ($qtyAvailable >= $cart[$id]['quantity'] + 1) {
                      $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                  } else {
                      $this->get('session')->setFlash('notice', 'Quantity     exceeds the available stock');
                      return $this->redirect($this->generateUrl('cart'));
                  } */
            } else {
                // if it doesnt make it 1
                $cart[$id] = 1;
                //$cart[$id]['quantity'] = 1;
            }

            $session->set('cart', $cart);
//            echo('<pre>');
            //print_r($cart); echo ('</pre>');die();
            return $this->redirect($this->generateUrl('cart'));

        }
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkoutAction()
    {
        // verwerken van regels in de nieuwe factuur voor de huidige klant.
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $cart = $session->get('cart', array());

        // aanmaken factuur regel.
        $em = $this->getDoctrine()->getManager();
        if (TRUE === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $userAdress = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $this->getUser()->getId()));
        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        // new UserAdress if no UserAdress found...
        if (!$userAdress) {
            $userAdress = new User();
            $userAdress->setId($this->getUser()->getId());
        }

        $factuur = new Factuur();
        $factuur->setTimestamp(new \DateTime("now"));
        $factuur->setCustomerId($this->getUser());
        $factuur->setOpmerking("Geen Operkingen");
        $factuur->setBetaald("Geen aanbetaling");

        //var_dump($cart);
        // vullen regels met orderregels.
        // put invoice in dbase.
        if (isset($cart)) {
            // $data = $this->get('request_stack')->getCurrentRequest()->request->all();
            $em->persist($factuur);
            $em->flush();
            // put basket in dbase
            foreach ($cart as $id => $quantity) {
                $regel = new Product_history();
                $regel->setFactuurId($factuur);

                $em = $this->getDoctrine()->getManager();
                $product = $em->getRepository('ShopBundle:Artikel')->find($id);

                $regel->setAantal($quantity);
                $regel->setArtikelId($product);

                $em = $this->getDoctrine()->getManager();
                $em->persist($regel);
                $em->flush();
            }
        }


        $session->clear();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/remove/{id}", name="cart_remove")
     */
    public function removeAction($id)
    {
        // check the cart
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cart', array());

        // if it doesn't exist redirect to cart index page. end
        if (!$cart[$id]) {
            $this->redirect($this->generateUrl('cart'));
        }

        // check if the $id already exists in it.
        if (isset($cart[$id])) {
            $cart[$id] = $cart[$id] - 1;
            if ($cart[$id] < 1) {
                unset($cart[$id]);
            }
        } else {
            return $this->redirect($this->generateUrl('cart'));
        }

        $session->set('cart', $cart);

        //echo('<pre>');
        //print_r($cart); echo ('</pre>');die();

        return $this->redirect($this->generateUrl('cart'));
    }
}
