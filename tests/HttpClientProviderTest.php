<?php

namespace Tests;

// Pontos interessantes:
// https://stackoverflow.com/a/46025984/9881278

/**
 * @coversDefaultClass \NativeProviders\HttpClientProvider
 */
class HttpClientProviderTest extends \Tests\TestCase {
    public function newHttpClient(){
        return $this->new('\NativeProviders\HttpClientProvider');
    }

    /**
     * @dataProvider \Tests\DataProviders\HttpClient\Response::caminhosFelizes
     * @covers ::curl
     * @covers ::get
     */
    public function testDeveObterBody($method, $endpoint, $expectedResponse){
        $client = $this->newHttpClient();
        $response = $client->$method($endpoint, [
            'nossl' => true
        ]);
        // var_dump($response['body']);die;
        // var_dump($expectedResponse);die;

        $this->assertEquals($expectedResponse, $response['body']);
    }
}
