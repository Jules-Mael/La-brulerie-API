<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;




class CategorieController extends AbstractController
{

    private CategorieRepository $categorieRepository;
    private SerializerInterface $serializer;



    public function __construct(CategorieRepository $categorieRepository,
                                SerializerInterface $serializer,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator)
    {
        $this->categorieRepository = $categorieRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }
    /**
     * @Route("/api/categories", name="api_categorie_getallcategorie")
     */
    public function getAllCategorie(): Response
    {
        $categories = $this->categorieRepository->findAll();
        $categoriesjson =$this->serializer->serialize($categories, 'json');
        return new JsonResponse($categoriesjson, Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/api/categories/{id}", name="api_categorie_getbyidcategorie")
     */
    public function getCategorieById($id): Response
    {
        $categories = $this->categorieRepository->find($id);
        $categoriesjson =$this->serializer->serialize($categories, 'json');
        return new JsonResponse($categoriesjson, Response::HTTP_OK,[],true);
    }
}
