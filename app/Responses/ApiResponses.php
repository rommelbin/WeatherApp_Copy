<?php

declare(strict_types=1);

namespace App\Responses;

use Illuminate\Http\Response;

class ApiResponses
{
    static public function successResponse(?array $data, ?string $message, int $status): Response
    {
        return response(["data" => $data, "message" => $message, "success" => true], $status);
    }

    static public function errorResponse(array|string $errors, int $status): Response
    {
        return response(["errors" => $errors, "success" => false], $status);
    }
}
