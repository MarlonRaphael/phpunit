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

        $logger = $this->createMock(LoggerInterface::class);

        $user = 'test';
        $password = 'invalid-password';
        $gateway = new Gateway($httpClient, $logger, $user, $password);

        $name = 'Marlon Raphael';
        $creditCardNumber = 5555444488882222;
        $validity = new DateTime('now');
        $value = 100;

        $map = [
            [
                'POST',
                Gateway::BASE_URL . 'authenticate',
                [
                    'user' => $user,
                    'password' => $password
                ],
                null
            ]
        ];

        $httpClient
            ->expects($this->once())
            ->method('send')
            ->will($this->returnValueMap($map));

        $paid = $gateway->pay($name,  $creditCardNumber, $validity, $value);

        $this->assertEquals(false, $paid);
    }

    /**
     * @test
     * @return void
     */
    public function shouldNotPayWhenFailOnGateway(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);

        $logger = $this->createMock(LoggerInterface::class);

        $user = 'test';
        $password = 'valid-password';
        $gateway = new Gateway($httpClient, $logger, $user, $password);

        $name = 'Marlon Raphael';
        $creditCardNumber = 5555444488882222;
        $value = 100;
        $token = 'meu-token';
        $validity = new DateTime('now');

        $map = [
            [
                'POST',
                Gateway::BASE_URL . '/authenticate',
                [
                    'user' => $user,
                    'password' => $password
                ],
                $token
            ],
            [
                'POST',
                Gateway::BASE_URL . '/pay',
                [
                    'name' => $name,
                    'credit_card_number' => $creditCardNumber,
                    'validity' => $validity,
                    'value' => $value,
                    'token' => $token
                ],
                ['paid' => false]
            ],
        ];

        $httpClient
            ->expects($this->atLeast(2))
            ->method('send')
            ->will($this->returnValueMap($map));

        $paid = $gateway->pay($name, $creditCardNumber, $validity, $value);

        $this->assertEquals(false, $paid);
    }


    /**
     * @test
     * @return void
     */
    public function shouldSuccessfullyPayWhenGatewayReturnOk(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);

        $logger = $this->createMock(LoggerInterface::class);

        $user = 'test';
        $password = 'valid-password';
        $gateway = new Gateway($httpClient, $logger, $user, $password);

        $name = 'Marlon Raphael';
        $creditCardNumber = 9999999999999999;
        $validity = new DateTime('now');
        $value = 100;
        $token = 'meu-token';

        $map = [
            [
                'POST',
                Gateway::BASE_URL . '/authenticate',
                [
                    'user' => $user,
                    'password' => $password
                ],
                $token
            ],
            [
                'POST',
                Gateway::BASE_URL . '/pay',
                [
                    'name' => $name,
                    'credit_card_number' => $creditCardNumber,
                    'validity' => $validity,
                    'value' => $value,
                    'token' => $token
                ],
                ['paid' => true]
            ],
        ];

        $httpClient
            ->expects($this->atLeast(2))
            ->method('send')
            ->will($this->returnValueMap($map));

        $paid = $gateway->pay($name, $creditCardNumber, $validity, $value);

        $this->assertEquals(true, $paid);
    }
}
