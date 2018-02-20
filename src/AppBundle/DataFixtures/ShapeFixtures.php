<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ShapeFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $map = [
            Shape::TYPE_STAR => [
                Shape::SIZE_SMALL => <<< EOT
   +
   X
+XXXXX+
   X
   +
EOT
                ,
                Shape::SIZE_MEDIUM => <<< EOT
     +
     X
   XXXXX
+XXXXXXXXX+
   XXXXX
     X
     +
EOT
                ,
                Shape::SIZE_LARGE => <<< EOT
        +
        X
       XXX
     XXXXXXX
   XXXXXXXXXXX
+XXXXXXXXXXXXXXX+
   XXXXXXXXXXX
     XXXXXXX
       XXX
        X
        +
EOT
            ],
            Shape::TYPE_TREE => [
                Shape::SIZE_SMALL => <<< EOT
   +
   X
  XXX
 XXXXX
XXXXXXX
EOT
                ,
                Shape::SIZE_MEDIUM => <<< EOT
     +
     X
    XXX
   XXXXX
  XXXXXXX
 XXXXXXXXX
XXXXXXXXXXX
EOT
                ,
                Shape::SIZE_LARGE => <<< EOT
         +
         X
        XXX
       XXXXX
      XXXXXXX
     XXXXXXXXX
    XXXXXXXXXXX
   XXXXXXXXXXXXX
  XXXXXXXXXXXXXXX
 XXXXXXXXXXXXXXXXX
XXXXXXXXXXXXXXXXXXX
EOT
            ]
        ];

        foreach ($map as $type => $list) {
            foreach ($list as $size => $raw) {
                $shape = new Shape;
                $shape->setType($type);
                $shape->setSize($size);
                $shape->setRaw($raw);
                $manager->persist($shape);
            }
        }

        $manager->flush();
    }
}
