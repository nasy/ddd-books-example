<?php

namespace tests\Integration\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use AppBundle\DataFixtures\ORM\Book\BookData;

class BookControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = $this->makeClient();
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\Book\BookData'
        ]);
    }

    public function testGetBooks()
    {
        $route =  $this->getUrl('api_1_get_books');
        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

        $this->assertTrue(sizeof($decoded['data']) > 0);
        foreach($decoded['data'] as $row) {
            $this->assertInternalType('string', $row['id']);
            $this->assertInternalType('string', $row['title']);
            $this->assertInternalType('string', $row['author']);
            $this->assertInternalType('string', $row['created_at']);
        }
    }

    public function testGetBook()
    {
        $book = array_pop(BookData::$books);
        $route =  $this->getUrl('api_1_get_book',['id' => $book->id()]);
        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

        $this->assertInternalType('string', $decoded['data']['id']);
        $this->assertInternalType('string', $decoded['data']['title']);
        $this->assertInternalType('string', $decoded['data']['author']);
        $this->assertInternalType('string', $decoded['data']['created_at']);
    }

    public function testPostBook()
    {
        $route =  $this->getUrl('api_1_post_book');
        $this->client->request(
            'POST',
            $route,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"title1","author":"author1"}'
        );
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

        $this->assertInternalType('string', $decoded['data']['id']);
    }

    public function testPutBook()
    {
        $book = array_pop(BookData::$books);
        $route =  $this->getUrl('api_1_put_book', ['id'=> $book->id()]);
        $this->client->request(
            'PUT',
            $route,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"title2","author":"author2"}'
        );
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

        $this->assertInternalType('string', $decoded['status']);
        $this->assertTrue( $decoded['status'] == 'success');
    }

    public function testDeleteBook()
    {
        $book = array_pop(BookData::$books);
        $route =  $this->getUrl('api_1_delete_book', ['id'=> $book->id()]);
        $this->client->request(
            'DELETE',
            $route
        );
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

        $this->assertInternalType('string', $decoded['status']);
        $this->assertTrue( $decoded['status'] == 'success');
    }
}
