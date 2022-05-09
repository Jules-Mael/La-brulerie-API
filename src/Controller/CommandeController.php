<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;




class CommandeController extends AbstractController
{

    private CommandeRepository $commandeRepository;
    private SerializerInterface $serializer;


    public function __construct(CommandeRepository    $commandeRepository,
                                SerializerInterface    $serializer,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface     $validator)
    {
        $this->commandeRepository = $commandeRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @Route("/api/commandes", name="api_categorie_getallcommande")
     */
    public function getAllCategorie(): Response
    {
        $commandes = $this->commandeRepository->findAll();
        $categoriesjson = $this->serializer->serialize($commandes, 'json');
        return new JsonResponse($categoriesjson, Response::HTTP_OK, [], true);
    }
}
