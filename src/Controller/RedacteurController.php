<?php

namespace App\Controller;

use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;


class RedacteurController extends AbstractController
{

    private EmployeRepository $employeRepository;
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;




    public function __construct(EmployeRepository    $employeRepository,
                                SerializerInterface    $serializer,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface     $validator)
    {
        $this->employeRepository = $employeRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @Route("/api/redacteurs", name="app_redacteur_getRedacteurs")
     */
    public function getRedacteurs(EmployeRepository $employeRepository): Response
    {
        $redacteurs = $employeRepository->findAll();

        $listRedact= [];
        foreach ($redacteurs as $redacteur) {
            $role = $redacteur->getIdRole();
            $roleRedact = $role->getIdRole();
            if ($roleRedact == 1) $listRedact[] = $redacteur;
        }

        $redacteurJson = $this->serializer->serialize($listRedact, 'json');
        return new JsonResponse($redacteurJson, Response::HTTP_OK,[],true);

    }

    /**
     * @Route("/api/redacteurs/delete/{idRedacteur}", name="app_redacteur_deletedRedacteur")
     */

    public function deleteRedacteur(int $idRedacteur) : Response
    {
        try {
            // Recherche du post dont l'id est $id
            $redacteur = $this->employeRepository->find($idRedacteur);
            // Suppression dans la base de données
            $this->entityManager->remove($redacteur);
            $this->entityManager->flush();
            // Renvoyer une réponse HTTP
            return new JsonResponse(null,Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            $error = [
                "status" => Response::HTTP_NOT_FOUND,
                "message" => "La ressource demandée n'est pas accessible."
            ];
            return new JsonResponse(json_encode($error), $error["status"], [], true);
        }
    }
}
