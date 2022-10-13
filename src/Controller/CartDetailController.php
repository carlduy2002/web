<?php

namespace App\Controller;

use App\Entity\CartDetail;
use App\Repository\CartDetailRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartDetailController extends AbstractController
{
    // /**
    //  * @Route("/cart/detail", name="app_cart_detail")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('cart_detail/index.html.twig', [
    //         'controller_name' => 'CartDetailController',
    //     ]);
    // }
    /**
     * @Route("/contain/{id}", name="cart_page")
     */
    public function addCartAction(ProductRepository $repo, $id, ManagerRegistry $res,
        CartRepository $cartRepo, CartDetailRepository $contRepo): Response
    {

        $entity = $res->getManager();
        $cartDetail = new CartDetail();

        $user = $this->getUser();

        $cart = $cartRepo->findOneBy(['user'=>$user]);//cart

        $product = $repo->find($id);
        
        $cont = $contRepo->checkQty($id, $cart);

        if($cont[0]['count'] == 0){
            $cartDetail->setCartID($cart);
            $cartDetail->setProductID($product);
            $cartDetail->setQtyPro(1);
    
            $entity->persist($cartDetail);
            $entity->flush();
    
        }
        else{

            $quantity = $cont[0]['quantity'] + 1;

            $containID = $cont[0]['id'];
            $contain = $contRepo->find($containID);
            
            $contain->setQtyPro($quantity);

            $entity->persist($contain);
            $entity->flush();
        }


        return $this->redirectToRoute('product_page');
    }

    
    /**
     * @Route("/deleteContain/{id}", name="delete_cart")
     */
    public function deleteCartAction($id, CartDetailRepository $repo, ManagerRegistry $res): Response
    {
        $entity = $res->getManager();
        $contain = $repo->find($id);

        $entity->remove($contain);
        $entity->flush();

        return $this->redirectToRoute('showcart');
    }


    /**
     * @Route("/updateContain/{id}", name="update_cart")
     */
    public function FunctionName(Request $req, $id, CartDetailRepository $repo, ManagerRegistry $res): Response
    {
        $entity = $res->getManager();
        $contain = $repo->find($id);
        $form = $this->createForm(UpdateCartType::class, $contain);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){
            $contain->setQtyPro($form->get('Qty_Product')->getData());

            $entity->persist($contain);
            $entity->flush();

            return $this->redirectToRoute('showcart');
        } 
        
        return $this->render('contain/UpdateCart.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
