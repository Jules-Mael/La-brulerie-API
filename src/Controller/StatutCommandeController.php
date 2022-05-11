<?php

namespace App\Controller;

use App\Repository\StatuCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class StatutCommandeController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager,
                                ValidatorInterface $validator,
                                SerializerInterface $serializer, StatuCommandeRepository $statuCommandeRepository)
    {
        $this->statutCommandeRepository = $statuCommandeRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @Route("/api/statutcommande", name="api_statutcommande_getallstatutcommande")
     */
    public function  getAllStatuCommande(): Response
    {
        $statutCommande = $this->statutCommandeRepository->findAll();
        $statutCommandeJson =$this->serializer->serialize($statutCommande, 'json');
        return new JsonResponse($statutCommandeJson, Response::HTTP_OK,[],true);
    }
}
