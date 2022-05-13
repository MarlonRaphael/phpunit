<?php

namespace PaymentBundle\Test\Service;

use DateTime;
use MyFramework\HttpClientInterface;
use MyFramework\LoggerInterface;
use PaymentBundle\Service\Gateway;
use PHPUnit\Framework\TestCase;

class GatewayTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function shouldNotPayWhenAuthenticationFail(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->method('send')
            ->will($this->returnCallback(function ($method, $address, $body) {
                $this->fakeHttpClientSend($method, $address, $body);
            }));

        $logger = $this->createMock(LoggerInterface::class);

        $user = 'test';
        $password = 'invalid-password';
        $gateway = new Gateway($httpClient, $logger, $user, $password);

        $paid = $gateway->pay(
            'Marlon Raphael',
            5555444488882222,
            new DateTime('now'),
            100);

        $this->assertEquals(false, $paid);
    }

    /**
     * @test
     * @return void
     */
    public function shouldNotPayWhenFailOnGateway(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->method('send')
            ->will($this->returnCallback(function ($method, $address, $body) {
                $this->fakeHttpClientSend($method, $address, $body);
            }));

        $logger = $this->createMock(LoggerInterface::class);

        $user = 'test';
        $password = 'valid-password';
        $gateway = new Gateway($httpClient, $logger, $user, $password);

        $paid = $gateway->pay(
            'Marlon Raphael',
            5555444488882222,
            new DateTime('now'),
            100);

        $this->assertEquals(false, $paid);
    }

    /**
     * @test
     * @return void
     */
    public function shouldSuccessfullyPayWhenGatewayReturnOk(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->method('send')
            ->will($this->returnCallback(function ($method, $address, $body) {
                $this->fakeHttpClientSend($method, $address, $body);
            }));

        $logger = $this->createMock(LoggerInterface::class);

        $user = 'test';
        $password = 'valid-password';
        $gateway = new Gateway($httpClient, $logger, $user, $password);

        $paid = $gateway->pay(
            'Marlon Raphael',
            9999999999999999,
            new DateTime('now'),
            100);

        $this->assertEquals(true, $paid);
    }

    /**
     * @param $method
     * @param $address
     * @param $body
     * @return bool[]|false[]|string|void|null
     */
    public function fakeHttpClientSend($method, $address, $body)
    {
        var_dump($body);

        switch ($address) {
            case Gateway::BASE_URL . '/authenticate':

                if ($body['password'] !== 'valid-password') {
                    return null;
                }

                return 'meu-token';

                break;
            case Gateway::BASE_URL . '/pay':

                if ($body['credit_card_number'] === 9999999999999999) {
                    return ['paid' => true];
                }

                return ['paid' => false];

                break;
        }
    }
}
