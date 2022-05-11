<?php

namespace OrderBundle\Test\Service;

use OrderBundle\Repository\BadWordsRepositoryInterface;

class BadWordsRepositoryStub implements BadWordsRepositoryInterface
{
    /**
     * @return array
     */
    public function findAllAsArray(): array
    {
        return ['bobo', 'burro', 'besta', 'chule'];
    }

}
