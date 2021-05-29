<?php

namespace App\Providers;

use App\Policies\GalerijaPolicy;
use App\Models\Galerija;

use App\Policies\ProizvodPolicy;
use App\Models\Proizvod;

use App\Policies\OblikPolicy;
use App\Models\Oblik;

use App\Policies\MaterijalPolicy;
use App\Models\Materijal;

use App\Policies\FontPolicy;
use App\Models\Font;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Galerija::class => GalerijaPolicy::class,
        Proizvod::class => ProizvodPolicy::class,
        Oblik::class => OblikPolicy::class,
        Materijal::class => MaterijalPolicy::class,
        Font::class => FontPolicy::class,


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
