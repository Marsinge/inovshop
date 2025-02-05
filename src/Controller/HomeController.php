<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer les 3 derniers produits
        $latestProducts = $entityManager->getRepository(Product::class)->findBy([], ['createdAt' => 'DESC'], 3);

        // Récupérer les 3 produits à la une
        $featuredProducts = $entityManager->getRepository(Product::class)->findBy([], ['price' => 'DESC'], 3);

        return $this->render('home/index.html.twig', [
            'latestProducts' => $latestProducts,
            'featuredProducts' => $featuredProducts,
        ]);
    }



    #[Route('/catalogue', name: 'app_catalogue')]
    public function catalogue(): Response
    {

        return $this->render('home/catalogue.html.twig', [

        ]);
    }


    #[Route('/panier', name: 'app_panier')]
    public function panier(): Response
    {
        return $this->render('home/panier.html.twig', [

        ]);
    }




    #[Route('/commande', name: 'app_commande')]
    public function commande(): Response
    {
        return $this->render('home/commande.html.twig', [

        ]);
    }

    #[Route('/client', name: 'app_client')]
    public function client(): Response
    {
        return $this->render('home/client.html.twig', [

        ]);
    }
}
