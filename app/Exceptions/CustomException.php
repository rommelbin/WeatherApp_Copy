<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use App\Responses\ApiResponses;
use Illuminate\Http\Response;

class CustomException extends Exception
{
    private array|string $errors;
    private int $status;

    public function __construct(array|string $errors, int $status, Exception $previous = NULL)
    {
        parent::__construct("customErrorHandling", $status, $previous);
        $this->status = $status;
        $this->errors = $errors;
    }

    public function render(): Response
    {
        return ApiResponses::errorResponse($this->errors, $this->status);
    }
}
