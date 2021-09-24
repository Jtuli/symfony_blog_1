<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use App\Form\ItemType;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminItemController extends AbstractController
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
     * @Route("/admin", name="admin.item.index")
     * @return Response
     */
    public function index()
    {
        $items = $this->repository->findAll();
        return $this->render('admin/item/index.html.twig', compact('items'));
    }

    /**
     * @Route("/admin/item/create", name="admin.item.new")
     */

    public function new(Request $request) {
        $item = new Item();

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($item);
            $this->em->flush();
            $this->addFlash('success', 'Article crée avec succès');
            return $this->redirectToRoute('admin.item.index');

        }

        return $this->render('admin/item/new.html.twig', [
            'item' => $item,
            'form' => $form->createView()
        ]);
    }


      /**
     * Undocumented function
     * @Route("/admin/item/edit-{id}", name="admin.item.edit")
     * @return Response
     */
    public function edit(Item $item, Request $request)
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Article modifié avec succès');
            return $this->redirectToRoute('admin.item.index');

        }
        return $this->render('admin/item/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView()
        ]);
    }

    /**
     * Undocumented function
     * @Route("/admin/item/delete-{id}", name="admin.item.delete")
     * @return Response
     */

    public function delete(Item $item, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $item->getId(), $request->get('_token'))) {
            $this->em->remove($item);
            $this->em->flush();
            $this->addFlash('success', 'Article supprimé avec succès');
            return $this->redirectToRoute('admin.item.index');
        }
    }
}