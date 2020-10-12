<?php

namespace App\Exceptions;

use App\Http\Controllers\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render_bak($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    public function render($request, Throwable $exception)
    {
        if($request->is("api/*")){
            if (env('APP_DEBUG')){
                return $this->failed($exception->getMessage(), 500);
            }
            return $this->failed('system error', 500);
        }
        return parent::render($request, $exception);
    }
}