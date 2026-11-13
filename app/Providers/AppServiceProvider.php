<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Gate::define('kelola-pelanggan', fn (User $user) => $user->hasRole(User::ROLE_ADMIN, User::ROLE_STAFF));

        Gate::define('hapus-pelanggan', fn (User $user) => $user->hasRole(User::ROLE_ADMIN));
    }
}
