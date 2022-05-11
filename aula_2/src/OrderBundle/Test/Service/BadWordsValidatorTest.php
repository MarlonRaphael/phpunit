<?php

namespace OrderBundle\Test\Service;

use JetBrains\PhpStorm\ArrayShape;
use OrderBundle\Repository\BadWordsRepository;
use OrderBundle\Service\BadWordsValidator;
use PHPUnit\Framework\TestCase;

class BadWordsValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider badWordsDataProvider
     * @param $badWordsList
     * @param $text
     * @param $foundBadWords
     * @return void
     */
    public function hasBadWords($badWordsList, $text, $foundBadWords): void
    {
//        $badWordsRepository = new BadWordsRepositoryStub();

        $badWordsRepository = $this->createMock(BadWordsRepository::class);

        $badWordsRepository
            ->method('findAllAsArray')
            ->willReturn($badWordsList);

        $badWordsValidator = new BadWordsValidator($badWordsRepository);

        $hasBadWords = $badWordsValidator->hasBadWords($text);

        $this->assertEquals($foundBadWords, $hasBadWords);
    }

    /**
     * @return array[]
     */
    #[ArrayShape([
        'shouldFindWhenHasBadWords' => "array",
        'shouldNotFindWhenHasNoBadWords' => "array",
        'shouldNotFindWhenTextIsEmpty' => "array",
        'shouldnotFindWhenBadWordsListIsEmpty' => "array"
    ])] public function badWordsDataProvider(): array
    {
        return [
            'shouldFindWhenHasBadWords' => [
                'badWordsList' => ['bobo', 'burro', 'besta', 'chule'],
                'text' => 'Seu restaurante é muito bobo',
                'foundBadWords' => true
            ],
            'shouldNotFindWhenHasNoBadWords' => [
                'badWordsList' => ['bobo', 'burro', 'besta', 'chule'],
                'text' => 'Trocar batata por salada',
                'foundBadWords' => false
            ],
            'shouldNotFindWhenTextIsEmpty' => [
                'badWordsList' => ['bobo', 'burro', 'besta', 'chule'],
                'text' => '',
                'foundBadWords' => false
            ],
            'shouldnotFindWhenBadWordsListIsEmpty' => [
                'badWordsList' => [],
                'text' => 'Seu restaurante é muito bobo',
                'foundBadWords' => false
            ],
        ];
    }
}
