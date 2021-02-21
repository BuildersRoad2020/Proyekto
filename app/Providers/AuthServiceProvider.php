<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      //  App\Models\Contractors::class => App\Policies\ContractorsPolicy::class,
        App\Models\User::class => App\Policies\UsersPolicy::class,
       // App\Models\ContractorDetails::class => App\Policies\ContractorDetailsPolicy::class,        
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

/*         Gate::define('contractors', function (){
            return $user->roleuser()->role_id == '1';
        }); */
    }
}
