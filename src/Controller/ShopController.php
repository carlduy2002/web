<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\Type\Shop as TypeShop;
use App\Form\Type\ShopType;
use App\Form\Type\ShType;
use App\Repository\ShopRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="app_shop")
     */
    public function index(ShopRepository $repo): Response
    {
        $shop = $repo->findAll();
        return $this->render('shop_manager/index.html.twig', [
            'shop' => $shop
        ]);
    }

    /**
     * @Route("/addShop", name="add_shop")
     */
    public function addAction(ManagerRegistry $res, Request $req): Response
    {
        $shop = new Shop();
        $form = $this->createForm(ShType::class, $shop);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $shop->setName($data->getName());
            $shop->setEmail($data->getEmail());
            $shop->setAddress($data->getAddress());
            $shop->setPhone($data->getPhone());

            $entity->persist($shop);
            $entity->flush();

            return $this->redirectToRoute('app_shop');
        }
        return $this->render('shop/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/editShop/{id}", name="edit_shop")
     */
    public function editAction(ManagerRegistry $res, Request $req, ShopRepository $repo, $id): Response
    {
        $shop = $repo->find($id);
        $form = $this->createForm(ShType::class, $shop);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $shop->setName($data->getName());
            $shop->setEmail($data->getEmail());
            $shop->setAddress($data->getAddress());
            $shop->setPhone($data->getPhone());

            $entity->persist($shop);
            $entity->flush();

            return $this->json([
                'id' => $shop->getId()
            ]);
        }
        return $this->render('shop/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/deleteShop/{id}", name="deleteShop")
    */
    public function deleteAction(ManagerRegistry $res, Request $req, ShopRepository $repo, $id): Response
    {
        $entity = $res->getManager();
        $shop = $repo->find($id);
        if(!$shop){
            return $this->json("No project found");
        }

        $entity->remove($shop);
        $entity->flush();

        return $this->redirectToRoute('app_shop');
    }
}
