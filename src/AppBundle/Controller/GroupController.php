<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends FOSRestController
{
    /**
     * @param Request $request
     * @return Group[]
     * @View(statusCode=200)
     * @Get("/groups/")
     */
    public function getGroupsAction(Request $request)
    {
        return $this->getDoctrine()
            ->getRepository(Group::class)
            ->findAll();
    }

    /**
     * @param Request $request
     * @return array
     * @View(statusCode=201)
     * @Post("/groups/")
     */
    public function postGroupAction(Request $request)
    {
        /** @var Group $group */
        $group = $this->get("serializer")->deserialize($request->getContent(), Group::class, 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($group);
        $em->flush();

        return new Response(null, 201);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array
     * @View(statusCode=200)
     * @Put("/groups/{id}/",
     * requirements={"id"})
     */
    public function updateGroupAction(Request $request, $id)
    {
        if (
            !$this->getDoctrine()
            ->getRepository(Group::class)
            ->find($id)
        ) {
            throw $this->createNotFoundException();
        }

        /** @var Group $group */
        $group = $this->get("serializer")->deserialize($request->getContent(), Group::class, 'json');
        $group->id = $id;
        $em = $this->getDoctrine()->getManager();
        $em->merge($group);
        $em->flush();


        return new Response(null, 200);
    }
}