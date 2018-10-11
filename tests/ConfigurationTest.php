<?php
declare(strict_types=1);

final class ConfigurationTest extends PHPUnit\Framework\TestCase
{
    protected $idp; // identity provider
    protected $sp; // service provider

    protected function setUp()
    {
        $this->idp = new GuzzleHttp\Client([
            'base_uri' => getenv('IDP_ENTITYID'),
            'http_errors' => false,
            'cookies' => true
        ]);
        $this->sp = new GuzzleHttp\Client([
            'base_uri' => getenv('SP_ENTITYID'),
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
        $spCheck = (strpos($contents, (string) $this->sp->getConfig('base_uri')) > 0);
        $this->assertTrue($spCheck);
    }

    public function testSpShowsIdpLogin()
    {
        $response = $this->sp->get('/login');
        $this->assertEquals(200, $response->getStatusCode());
        $contents = $response->getBody()->getContents();
        $validationErrors = (strpos($contents, "Errori di validazione") > 0);
        $this->assertFalse($validationErrors);
        $login = (strpos($contents, "Login") > 0);
        $this->assertTrue($login);
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
