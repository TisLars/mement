<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Hello world!', $crawler->filter('#test h1')->text());
    }

  //   public function testNumber()
  //   {
  //       $client = static::createClient();

  //       $crawler = $client->request('GET', '/number');

  //   	$form = $crawler->selectButton('submit')->form();

		// // set some values
		// $form['a'] = '14';
		// $form['b'] = '10';

		// // submit the form
		// $crawler = $client->submit($form);
  //   }
}
