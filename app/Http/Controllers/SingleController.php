<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Responses\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SingleController extends Controller
{
    public function handle(string $model, string $methodName, Request $request): Response
    {
        $modelClass = "\App\Models\\$model";
        $data = $modelClass::$methodName($request) ?? null;
        return ApiResponses::successResponse($data, $methodName, 200);
    }
}
