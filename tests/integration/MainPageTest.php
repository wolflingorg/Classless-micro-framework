<?php
namespace app\tests\integration;

use app\tests\AbstractTestCase;

class MainPageTest extends AbstractTestCase
{
    public function testGetValidStatusCode()
    {
        $response = $this->client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
