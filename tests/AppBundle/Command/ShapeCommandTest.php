<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Command;

use AppBundle\Command\ShapeCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ShapeCommandTest extends KernelTestCase
{

    /**
     * @dataProvider providerTestShapeNonInteractive
     * @param $parameters
     * @param $output
     */
    public function testShapeNonInteractive($parameters, $output)
    {
        $args = [];
        foreach ($parameters as $parameter => $value) {
            $args['--' . $parameter] = $value;
        }
        $command_output = $this->executeCommand($args);
        $this->assertContains($output, $command_output);
    }

    private function executeCommand(array $arguments, array $inputs = [])
    {
        self::bootKernel();

        $container = self::$kernel->getContainer();
        $command = new ShapeCommand($container->get('doctrine')->getManager());
        $command->setApplication(new Application(self::$kernel));

        $commandTester = new CommandTester($command);
        $commandTester->setInputs($inputs);
        $commandTester->execute($arguments);
        return $commandTester->getDisplay();
    }

    public function providerTestShapeNonInteractive()
    {
        return [
            [
                [
                    'type' => 1,
                    'size' => 1
                ], <<< EOT
   +
   X
+XXXXX+
   X
   +
EOT
            ],
            [
                [
                    'type' => 1,
                    'size' => 2
                ], <<< EOT
     +
     X
   XXXXX
+XXXXXXXXX+
   XXXXX
     X
     +
EOT
            ],
            [
                [
                    'type' => 1,
                    'size' => 3
                ], <<< EOT
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
            [
                [
                    'type' => 2,
                    'size' => 1
                ], <<< EOT
   +
   X
  XXX
 XXXXX
XXXXXXX
EOT
            ],
            [
                [
                    'type' => 2,
                    'size' => 2
                ], <<< EOT
     +
     X
    XXX
   XXXXX
  XXXXXXX
 XXXXXXXXX
XXXXXXXXXXX
EOT
            ],
            [
                [
                    'type' => 2,
                    'size' => 3
                ], <<< EOT
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
    }
}
