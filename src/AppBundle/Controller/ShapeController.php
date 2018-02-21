<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shape;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Repository\ShapeRepository;

class ShapeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, EntityManagerInterface $em)
    {
        $type = $request->get('type');
        $size = $request->get('size');

        /** @var ShapeRepository $rep */
        $rep = $em->getRepository(Shape::class);
        if ($type && $size) {
            $shape = $rep->getShapeBy($type, $size);
        } else {
            if (!$type && !$size) {
                $shape = $rep->getShapeRandom();
            } else {
                throw new BadRequestHttpException('Please, specify type and size');
            }
        }

        if (!$shape) {
            throw new NotFoundHttpException('Shape not found');
        }

        /** @var Shape $shape */
        return $this->render('default/index.html.twig', [
            'shape' => $shape->getRaw(true)
        ]);
    }
}
