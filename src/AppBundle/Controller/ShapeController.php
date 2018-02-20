<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shape;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShapeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, EntityManagerInterface $em)
    {
        $type = $request->get('type', Shape::TYPE_STAR);
        $size = $request->get('size', Shape::SIZE_MEDIUM);
        if (!in_array($type, array_keys(Shape::$type_list)) || !in_array($size, array_keys(Shape::$size_list))) {
            throw new NotFoundHttpException('Shape not found');
        }

        $rep = $em->getRepository(Shape::class);
        /** @var Shape $shape */
        $shape = $rep->findOneBy([
            'type' => $type,
            'size' => $size
        ]);

        return $this->render('default/index.html.twig', [
            'shape' => $shape->getRaw(true)
        ]);
    }
}
