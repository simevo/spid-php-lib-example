<?php
declare(strict_types=1);

final class Test1 extends PHPUnit\Framework\TestCase
{
    protected $idp; // identity provider
    protected $sp; // service provider

    protected function setUp()
    {
        $this->idp = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8088',
            'http_errors' => false,
            'cookies' => true
        ]);
        $this->sp = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8099',
            'http_errors' => false,
            'cookies' => true
        ]);
    }

    public function testIdpMetaData()
    {
        $response = $this->idp->get('/metadata');
        $this->assertEquals(200, $response->getStatusCode());
        $contents = $response->getBody()->getContents();
        // echo $contents . PHP_EOL;
        $samlCheck = (strpos($contents, "urn:oasis:names:tc:SAML:2.0:metadata") > 0);
        $this->assertTrue($samlCheck);
    }

    public function testSpMetaData()
    {
        $response = $this->sp->get('/metadata');
        $this->assertEquals(200, $response->getStatusCode());
        $contents = $response->getBody()->getContents();
        $samlCheck = (strpos($contents, "urn:oasis:names:tc:SAML:2.0:metadata") > 0);
        $this->assertTrue($samlCheck);
    }

    public function testIdpConfigured()
    {
        $response = $this->idp->get('/');
        $this->assertEquals(200, $response->getStatusCode());
        $contents = $response->getBody()->getContents();
        $spCheck = (strpos($contents, "http://localhost:8099") > 0);
        $this->assertTrue($spCheck);
    }

    public function testSpShowsIdpLogin()
    {
        $response = $this->sp->get('/login');
        $this->assertEquals(200, $response->getStatusCode());
        $contents = $response->getBody()->getContents();
        $validationErrors = (strpos($contents, "Errori di validazione") > 0);
        $this->assertFalse($validationErrors);
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
