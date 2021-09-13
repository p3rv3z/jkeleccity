<?php

namespace App\Providers;

use App\Models\AppConfig;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Paginator::useBootstrap();

    // Sharing AppConfig module data to all views
    View::share('appConfig', $this->getAppConfigData());
  }

  private function getAppConfigData() {
    if (Schema::hasTable('app_configs')) {
      return AppConfig::first();
    }
    return false;
  }
}
