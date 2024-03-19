<?php

namespace App\Exceptions;

use App\Http\Traits\GeneralTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use GeneralTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->segment(1) == 'api') {
            if ($exception instanceof AuthenticationException) {
                return $this->returnError(401, 'Your token has expired');
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->returnError(401, 'method not allowed');
            }
            if ($exception instanceof NotFoundHttpException) {
                return $this->returnError(401, 'The link does not exist');
            }
        }
        return parent::render($request, $exception);
    }
}
?>
