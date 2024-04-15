<?php

namespace App\Controller;

use App\Repository\PaysRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PaysRepository $paysRepository)
    {

        try{

            $pays = $paysRepository->findAll();
            
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'pays' => $pays
            ]);
        }catch(Exception $e){
            return new Response($e->getMessage());
        }
    }
}
