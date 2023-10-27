<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
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
        UnauthorizedException::class,
        HttpException::class,
        AuthenticationException::class,
        ValidationException::class,
        NotFoundHttpException::class,
        BusinessException::class,
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

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(static function (Throwable $e) {

            return match (true) {
                $e instanceof BusinessException => new JsonResponse([
                    'errors' => ['messages' => [$e->getClientMessage()]]
                ], $e->getClientStatusCode()),
                $e instanceof UnauthorizedException,
                $e instanceof AuthenticationException =>  new JsonResponse([
                    'errors' => ['messages' => [$e->getMessage()]]
                ], Response::HTTP_UNAUTHORIZED),
                $e instanceof ValidationException => $e->getMessage(),
                default => new JsonResponse([
                    'errors' => ['messages' => ['Resource not found']]
                ], Response::HTTP_NOT_FOUND),
            };
        });
    }
}
