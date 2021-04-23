<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\CiudadesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class CiudadesController extends AbstractController{

    /**
     * @Route("/getCiudades", name="getAllCiudades", methods = {"GET"})
     * 
     */    
    public function getCiudades(Request $request, CiudadesRepository $ciudadesRepository):JsonResponse {

        $ciudades = $ciudadesRepository->getAllCiudades();

        return new JsonResponse($ciudades, Response::HTTP_OK);

    }
 
}



