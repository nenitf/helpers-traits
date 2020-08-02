<?php

namespace Tests;

// Pontos interessantes:
// https://stackoverflow.com/a/46025984/9881278

/**
 * @coversDefaultClass \Traits\Curl
 */
class CurlTest extends \Tests\TestCase {
    public function newCurl(){
        return $this->newTrait('\Traits\Curl');
    }

    /**
     * @dataProvider \Tests\DataProviders\Curl\Response::caminhosFelizes
     * @covers ::curl
     * @covers ::get
     */
    public function testDeveObterBody($method, $endpoint, $expectedResponse){
        $client = $this->newCurl();
        $response = $client->$method($endpoint, [
            'nossl' => true
        ]);
        // var_dump($response['body']);die;
        // var_dump($expectedResponse);die;

        $this->assertEquals($expectedResponse, $response['body']);
    }
}
