<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
     
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(fn() => view('auth.register'));
        Fortify::loginView(fn() => view('auth.login'));

        $this->app->singleton(RegisterResponse::class, function() {
            return new class implements RegisterResponse {
                public function toResponse($request) {
                    return redirect()->route('admin');
                }
            };
        });

        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                public function toResponse($request) {
                    return redirect()->route('admin');
                }
            };
        });
        
        $this->app->bind(
            \Laravel\Fortify\Http\Requests\LoginRequest::class,
            LoginRequest::class
        );

        $this->app->singleton(LogoutResponse::class, function () {
        return new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect()->route('login');
            }
        };
    });
    }
}