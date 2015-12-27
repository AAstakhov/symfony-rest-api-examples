<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as FE;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

class RestApiController extends Controller
{
    /**
     * @Rest\Get("/posts/{id}")
     *
     * @param Post $post
     *
     * @return Post
     */
    public function getPostAction(Post $post)
    {
        return $post;
    }

    /**
     * @Rest\Put("/posts/{id}")
     * @FE\ParamConverter("post", converter="fos_rest.request_body")
     *
     * @param Post $post
     *
     * @return Post
     */
    public function putPostAction(Post $post)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $post;
    }
}
