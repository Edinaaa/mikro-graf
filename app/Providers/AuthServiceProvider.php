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
use App\Policies\ArtikalPolicy;
use App\Models\Artikal;
use App\Policies\StanjePolicy;
use App\Models\Stanje;

use App\Policies\NarudzbaPolicy;
use App\Models\Narudzba;
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
        Narudzba::class => NarudzbaPolicy::class,

        Oblik::class => OblikPolicy::class,
        Materijal::class => MaterijalPolicy::class,
        Font::class => FontPolicy::class,
        Artikal::class => ArtikalPolicy::class,
        Stanje::class => StanjePolicy::class,




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
