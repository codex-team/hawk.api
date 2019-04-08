<?php

declare(strict_types=1);

namespace App\Components\Models\Exceptions;

/**
 * Class RecordNotFoundException
 * @package App\Components\Models\Exceptions
 */
class RecordNotFoundException extends BaseException
{
    /**
     * RecordNotFoundException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct(string $message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
