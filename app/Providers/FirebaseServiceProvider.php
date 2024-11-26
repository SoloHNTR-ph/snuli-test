<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Firestore;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Firestore::class, function ($app) {
            $serviceAccount = ServiceAccount::fromJsonFile(config('firebase.credentials_file'));
            return (new Factory)
                ->withServiceAccount($serviceAccount)
                ->createFirestore();
        });
    }

    public function boot()
    {
        //
    }
}