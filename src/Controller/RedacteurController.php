<?php

namespace App\Controller;

use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RedacteurController extends AbstractController
{

    private EmployeRepository $employeRepository;
    private SerializerInterface $serializer;

    public function __construct(EmployeRepository $employeRepository, SerializerInterface $serializer)
    {
        $this->employeRepository = $employeRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/redacteurs", name="app_redacteur_getRedacteurs")
     */
    public function getRedacteurs(): JsonResponse
    {
        $redacteurs = $this->employeRepository->findAll();
        $listRedact= [];
        foreach ($redacteurs as $redacteur) {
            $role = $redacteur->getIdRole();
            if ($role == 1) $listRedact[] = $redacteur;
        }

        $redacteurJson = $this->serializer->serialize($listRedact, 'json');
        return new JsonResponse($redacteurJson, Response::HTTP_OK,[],true);

    }
}
