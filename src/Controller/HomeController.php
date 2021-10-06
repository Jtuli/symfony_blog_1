<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @var ItemRepository
     */
    private $repository;



    public function __construct(ItemRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $items= $this->repository->findLimitedQuery();
        return $this->render('pages/home.html.twig', [
            'current_menu' => 'home',
            'items' => $items

        ]);
    }
}