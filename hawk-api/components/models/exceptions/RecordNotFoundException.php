<?php

declare(strict_types=1);

namespace App\Components\Models\Exceptions;

/**
 * Class ModelException
 *
 * @package App\Components\Base\Exceptions
 */
class RecordNotFoundException extends \Exception
{
    /**
     * RecordNotFoundException constructor.
     *
     * @param string          $collectionName
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct(string $collectionName, $message = 'Record not found.', $code = 0, \Exception $previous = null)
    {
        $message .= " Collection: $collectionName. ";

        parent::__construct($message, $code, $previous);
    }
}
