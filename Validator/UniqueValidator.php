<?php

declare(strict_types=1);

namespace Framework\Validator;

use Framework\Manager\EntityManager;

class UniqueValidator extends Validator
{
    private EntityManager $entityManager;

	public function __construct(string $error, EntityManager $manager)
	{
        $this->error = $error;
        $this->entityManager = $manager;
	}

	public function isValid($value): bool
	{     
        $method = 'isExists';

		if (is_callable([$this->entityManager, $method])) {
            $isUnique = $this->entityManager->$method($value);

            return !$isUnique;
        }

        return false;
	}
}