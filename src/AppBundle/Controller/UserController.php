<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController
{
    /**
     * @param Request $request
     * @return User[]
     * @View(statusCode=200)
     * @Get("/users/")
     */
    public function getUsersAction(Request $request)
    {
        return new JsonResponse($this->getDoctrine()
            ->getRepository(User::class)
            ->findAll(), JsonResponse::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return array
     * @View(statusCode=201)
     * @Post("/users/")
     */
    public function postUserAction(Request $request)
    {
        /** @var User $user */
        $user = $this->get("serializer")->deserialize($request->getContent(), User::class, 'json');

        if (!$this->getDoctrine()
            ->getRepository(Group::class)
            ->find($user->groupId)) {
            throw $this->createNotFoundException("Group {$user->groupId} not found");
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array
     * @View(statusCode=200)
     * @Get("/users/{id}/",
     * requirements={"id"})
     */
    public function getUserAction(Request $request, $id)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        if (!$user) {
            throw $this->createNotFoundException();
        }

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array
     * @View(statusCode=200)
     * @Put("/users/{id}/",
     * requirements={"id"})
     */
    public function updateUserAction(Request $request, $id)
    {
        if (
            !$this->getDoctrine()
            ->getRepository(User::class)
            ->find($id)
        ) {
            throw $this->createNotFoundException();
        }

        /** @var User $user */
        $user = $this->get("serializer")->deserialize($request->getContent(), User::class, 'json');

        if (!$this->getDoctrine()
            ->getRepository(Group::class)
            ->find($user->groupId)) {
            throw $this->createNotFoundException("Group {$user->groupId} not found");
        }

        $user->id = $id;
        $em = $this->getDoctrine()->getManager();
        $em->merge($user);
        $em->flush();

        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }
}