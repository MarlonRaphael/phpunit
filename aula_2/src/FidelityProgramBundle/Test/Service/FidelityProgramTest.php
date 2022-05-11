<?php

namespace FidelityProgramBundle\Test\Service;

use FidelityProgramBundle\Repository\PointsRepository;
use FidelityProgramBundle\Service\FidelityProgramService;
use FidelityProgramBundle\Service\PointsCalculator;
use MyFramework\LoggerInterface;
use OrderBundle\Entity\Customer;
use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\TestCase;

class FidelityProgramTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function shouldSaveWhenReceivePoints(): void
    {
        $pointsRepository = $this->createMock(PointsRepository::class);

        $pointsRepository
            ->expects($this->once())
            ->method('save');

//        $pointsRepository = new PointsRepositorySpy();

        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator
            ->method('calculatePointsToReceive')
            ->willReturn(100);

        $allMessages = [];
        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('log')->will($this->returnCallback(function ($message) use (&$allMessages) {
            $allMessages[] = $message;
        }));

        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator, $logger);

        $customer = $this->createMock(Customer::class);
        $value = 50;
        $fidelityProgramService->addPoints($customer, $value);

        $expectedMessages = [
            'Checking points for customer',
            'Customer received points'
        ];

        $this->assertEquals($expectedMessages, $allMessages);

//        $this->assertTrue($pointsRepository->called());
    }

    public function shouldNotSaveWhenReceiveZeroPoints(): void
    {
        $pointsRepository = $this->createMock(PointsRepository::class);

        $pointsRepository
            ->expects($this->never())
            ->method('save');

        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator
            ->method('calculatePointsToReceive')
            ->willReturn(0);

        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator);

        $customer = $this->createMock(Customer::class);

        $value = 20;

        $fidelityProgramService->addPoints($customer, $value);
    }
}
