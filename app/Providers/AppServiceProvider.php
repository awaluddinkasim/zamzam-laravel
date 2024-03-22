<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $pengaturan = [];
            $dataPengaturan = Setting::all();

            foreach ($dataPengaturan as $data) {
                $pengaturan[$data->key] = $data->value;
            }

            View::share('pengaturan', $pengaturan);
        } catch (\Throwable $th) {
        }
    }
}
