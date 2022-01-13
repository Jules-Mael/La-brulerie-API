<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ProduitController extends AbstractController
{

    private ProduitRepository $produitRepository;
    private SerializerInterface $serializer;
    private CategorieRepository $categorieRepository;

    public function __construct(ProduitRepository $produitRepository,
                                SerializerInterface $serializer,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator,
                                CategorieRepository $categorieRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->categorieRepository = $categorieRepository;
    }

    /**
     * @Route("/api/produits", name="api_produits_getProduits")
     */
    public function getAllProduits(): Response
    {
        $produit = $this->produitRepository->findAll();
        $produitJson = $this->serializer->serialize($produit, 'json');
        return new JsonResponse($produitJson, Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/api/produit/{id}", name="api_produit_getbyidcategorie")
     */
    public function getProduitById(int $id): Response
    {
        $produit = $this->produitRepository->find($id);
        $produitJson =$this->serializer->serialize($produit, 'json');
        return new JsonResponse($produitJson, Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/api/categorie/{libelleCategorie}", name="api_produit_getproduitsbycategorie", methods={"GET"})
     */
    public function getProduitsByCategorie($libelleCategorie)
    {
        $categories = $this->categorieRepository->findOneBy(array('libelleCategorie' => $libelleCategorie));
        $idCategorie = $categories->getIdCategorie();
        $produits = $this->produitRepository->findBy(array('idCategorie' => $idCategorie));
        $produitsJson = $this->serializer->serialize($produits,'json');
        return new JsonResponse($produitsJson,Response::HTTP_OK,[] ,true);
    }

    /**
     * @Route("/api/produits/{idProduit}", name="api_produit_getcategoriebyproduit", methods={"GET"})
     */
    public function getCategorieByProduit($idProduit)
    {
        $produits = $this->produitRepository->find($idProduit);
        $idCategorie = $produits->getIdCategorie();
        $catgorie = $this->categorieRepository->find($idCategorie);
        $libelleCategorie = $catgorie->getLibelleCategorie();
        $libelleCategorieJson = $this->serializer->serialize($libelleCategorie,'json');
        return new JsonResponse($libelleCategorieJson,Response::HTTP_OK,[] ,true);
    }
}
