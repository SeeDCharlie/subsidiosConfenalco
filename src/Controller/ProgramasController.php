<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\ProgramasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class ProgramasController extends AbstractController{

    /**
     *  @Route("/programas",name="programas")
     */
    public function getAllProgramas(Request $request, ProgramasRepository $programasRepository): JsonResponse {

        $programDatas = $programasRepository->getProgramasSQL();
        
        return new JsonResponse($programDatas, Response::HTTP_OK);

    }



}


