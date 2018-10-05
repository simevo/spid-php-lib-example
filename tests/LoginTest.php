<?php
declare(strict_types=1);

final class LoginTest extends PHPUnit\Framework\TestCase
{

    public function testLogin()
    {
        $client = new \Goutte\Client();
        // Do more configuration for the Goutte client
        $driver = new \Behat\Mink\Driver\GoutteDriver($client);
        $session = new \Behat\Mink\Session($driver);
        // start the session
        $session->start();

        $session->visit('http://localhost:8099/acs');
        $page = $session->getPage();
        $notLoggedIn = (strpos($page->getHtml(), "Not logged in") > 0);
        $this->assertTrue($notLoggedIn);

        $session->visit('http://localhost:8099/login');
        $page = $session->getPage();
        $page->fillField('username', 'test');
        $page->fillField('password', 'test');
        $page->pressButton('Invia');
        $page->pressButton('Invia');
        $page->pressButton('Continua');
        $fiscalNumberCheck = (strpos($page->getHtml(), "fiscalNumber") > 0);
        $this->assertTrue($fiscalNumberCheck);

        $session->visit('http://localhost:8099/login');
        $page = $session->getPage();
        $alreadyLogged = (strpos($page->getHtml(), "Already logged") > 0);
        $this->assertTrue($alreadyLogged);

        $session->visit('http://localhost:8099/logout');
        $page = $session->getPage();
        $page->pressButton('Continua');
        $logoutSuccesful = (strpos($page->getHtml(), "Logout succesful") > 0);
        $this->assertTrue($logoutSuccesful);

        $session->visit('http://localhost:8099/acs');
        $page = $session->getPage();
        $notLoggedIn = (strpos($page->getHtml(), "Not logged in") > 0);
        $this->assertTrue($notLoggedIn);
   }

   public function testLoginPost()
   {
       $client = new \Goutte\Client();
       // Do more configuration for the Goutte client
       $driver = new \Behat\Mink\Driver\GoutteDriver($client);
       $session = new \Behat\Mink\Session($driver);
       // start the session
       $session->start();

       $session->visit('http://localhost:8099/acs');
       $page = $session->getPage();
       $notLoggedIn = (strpos($page->getHtml(), "Not logged in") > 0);
       $this->assertTrue($notLoggedIn);

       $session->visit('http://localhost:8099/login-post');
       $page = $session->getPage();
       $page->find('css', 'form')->submit();
       $page = $session->getPage();
       $page->fillField('username', 'test');
       $page->fillField('password', 'test');
       $page->pressButton('Invia');
       $page->pressButton('Invia');
       $page->pressButton('Continua');
       $fiscalNumberCheck = (strpos($page->getHtml(), "fiscalNumber") > 0);
       $this->assertTrue($fiscalNumberCheck);

       $session->visit('http://localhost:8099/login-post');
       $page = $session->getPage();
       $alreadyLogged = (strpos($page->getHtml(), "Already logged") > 0);
       $this->assertTrue($alreadyLogged);

       $session->visit('http://localhost:8099/logout');
       $page = $session->getPage();
       $page->pressButton('Continua');
       $logoutSuccesful = (strpos($page->getHtml(), "Logout succesful") > 0);
       $this->assertTrue($logoutSuccesful);

       $session->visit('http://localhost:8099/acs');
       $page = $session->getPage();
       $notLoggedIn = (strpos($page->getHtml(), "Not logged in") > 0);
       $this->assertTrue($notLoggedIn);
  }

}