<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

final class EntityNotFoundException extends RuntimeException
{
    public static function forId(
        string $entityName,
        int $id,
    ):self{
        return new self(
          sprintf('%s con ID %d non trovato', $entityName, $id)
        );
    }

}
