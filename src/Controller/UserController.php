<?php

namespace App\Controller;

use App\Repository\UsuariosRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\UserServices;
use Exception;


class UserController extends AbstractController
{

    /**
     * @Route("/UserRegistration", name="UserRegistration")
     * 
     */

    public function UserRegistration(Request $request, EntityManagerInterface $em, UserServices $us)
    {
        $response = new JsonResponse();
        if ($request->getMethod() == 'POST') {

            return $us->userRegistration(json_decode($request->getContent(), true), $em);
        } else {
            $response->setData(['success' => false, 'msj' => "Method GET don't response"]);
            return $response;
        }
    }


    /**
     * @Route("/getAllUsers", name="getAllUsers", methods = {"POST", "GET"})
     * 
     */

    public function getAllUser(UsuariosRepository $ur)
    {
        try {
            $response = new JsonResponse();

            $serializer = $this->get('serializer');
            $data = $serializer->serialize($ur->findAll(), 'json');

            $response->setData(['success' => true, 'usuarios' => json_decode( $data , true)]);
            return $response;

        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "error: {$error->getMessage()}"]);
            return $response;
        }
    }
    /**
     * @Route("/getUserByid", name="getUserByid", methods = {"POST"})
     * 
     */

    public function getUserByid(Request $request,UsuariosRepository $ur)
    {
        try {
            $response = new JsonResponse();
            $dats =json_decode($request->getContent(), true);
            $serializer = $this->get('serializer');
            $data = $serializer->serialize($ur->find($dats['id']), 'json');

            $response->setData(['success' => true, 'usuario' => json_decode( $data , true)]);
            return $response;

        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "error: {$error->getMessage()}"]);
            return $response;
        }
    }



}
