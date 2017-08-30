<?php
namespace app\tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

require('./vendor/autoload.php');

class AbstractTestCase extends TestCase
{
    /**
     * @var \GuzzleHttp\ClientInterface $client
     */
    protected $client;

    protected function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8000'
        ]);
    }
}
