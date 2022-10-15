<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopManagerController extends AbstractController
{
    /**
     * @Route("/shopmanager", name="app_shop_manager")
     */
    public function shopManagerAction(): Response
    {
        return $this->render('shop_manager/index.html.twig', [
            'controller_name' => 'ShopManagerController',
        ]);
    }
}
