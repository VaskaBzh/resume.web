<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(static function (Throwable $e) {
            if ($e instanceof NotFoundHttpException) {
                return new JsonResponse([
                    'message' => $e->getMessage()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($e instanceof UnauthorizedException) {
                return new JsonResponse([
                    'message' => $e->getMessage()
                ], Response::HTTP_UNAUTHORIZED);
            }

            if ($e instanceof HttpException) {
                return new JsonResponse([
                    'message' => $e->getMessage()
                ], Response::HTTP_FORBIDDEN);
            }
        });
    }
}
