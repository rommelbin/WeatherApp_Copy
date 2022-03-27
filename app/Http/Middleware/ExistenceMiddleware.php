<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use App\Models;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exceptions\CustomException;

class ExistenceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $modelName = ucfirst($request->model);
        $methodName = $request->methodName;
        $id = $request->id;

        throw_if(!class_exists("\App\Models\\$modelName"), new CustomException("Model does not exist", 404));
        throw_if(!method_exists("\App\Models\\$modelName", $methodName), new CustomException("Method does not exist", 404));
        if ($id) {
            $modelClass = "\App\Models\\$modelName";
            throw_if(!$modelClass::where('id', $id)->exists(), new CustomException("ID does not exist", 404));
        }
        return $next($request);
    }
}
