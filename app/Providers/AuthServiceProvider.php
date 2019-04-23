<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Role;
use App\Models\Script;
use App\Policies\PagePolicy;
use App\Policies\RolesPolicy;
use App\Policies\ScriptPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolesPolicy::class,
        Page::class => PagePolicy::class,
        Script::class => ScriptPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
