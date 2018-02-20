<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShapeControllerTest extends WebTestCase
{

    /**
     * @dataProvider providerTestIndex
     * @param $parameters
     * @param $output
     */
    public function testIndex($parameters, $output)
    {
        $client = static::createClient();
        $client->request('GET', '/', $parameters);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $html = str_replace('&nbsp;', ' ', strip_tags($client->getResponse()->getContent()));
        $needle = str_replace("\n", PHP_EOL, $output);
        $this->assertContains($needle, $html);
    }

    public function providerTestIndex()
    {
        return [
            [
                [], <<< EOT
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
            ],
        ];
    }
}
