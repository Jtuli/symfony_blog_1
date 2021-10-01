<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\ItemSearch;
use App\Form\ItemSearchType;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
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
     * Undocumented function
     * @Route("/item", name="item.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginatorInterface, Request $request) : Response
    {
        $search = new ItemSearch;
        $form = $this->createForm(ItemSearchType::class, $search);
        $form->handleRequest($request);
        $items = $paginatorInterface->paginate(
                    $this->repository->findAllVisibleQuery($search),
                    $request->query->getInt('page', 1), 12);
        //$this->em->flush();
        return $this->render('item/index.html.twig', [
            'current_menu' => 'items',
            'items' => $items,
            'form' => $form->createView()

        ]);
    }

    
    /**
     * Undocumented function
     * @Route("/item/{slug}-{id}", name="item.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Item $item
     * @return Response
     */
    public function show(Item $item, string $slug) : Response
    {
        if ($item->getSlug() !== $slug) {
            return $this->redirectToRoute('item.show', [
                'id' => $item->getId(),
                'slug' => $item->getSlug()
            ],301);
        }
        return $this->render('item/show.html.twig', [
            'item' => $item,
            'current_menu' => 'items'

        ]);
    }
}