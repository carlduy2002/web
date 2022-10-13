<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    // /**
    //  * @Route("/feedback", name="app_feedback")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('feedback/index.html.twig', [
    //         'controller_name' => 'FeedbackController',
    //     ]);
    // }
    /**
     * @Route("/feadback", name="app_feadback")
     */
    public function feadbackAction(FeedbackRepository $repo): Response
    {
        $feedback = $repo->findAll();

        return $this->render('feadback/index.html.twig', [
            'feedback' => $feedback
        ]);
    }

    /**
     * @Route("/addFeadback", name="add_feadback", methods={"POST"})
     */
    public function addFeadbackAction(ManagerRegistry $res, Request $req): Response
    {
        $getUname = $req ->request -> get('user-txt');
        $getEmail = $req ->request -> get('email-txt');
        $getPhone = $req ->request -> get('phone-txt');
        $getMess = $req ->request -> get('message-txt');
        $getProName = $req ->request -> get('product-txt');

        $user = $this->getUser();
       

        $feadback = new Feedback();
        $entity = $res->getManager();

        $feadback->setUsername($getUname);
        $feadback->setEmail($getEmail);
        $feadback->setPhone($getPhone);
        $feadback->setProductName($getProName);
        $feadback->setMessage($getMess);
        $feadback->setUsername($user);



        $entity->persist($feadback);
        $entity->flush();
        
        return $this->redirectToRoute('about_page');
    }
}
