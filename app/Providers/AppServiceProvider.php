<?php

namespace App\Providers;

use App\Http\Repositories\AttributeRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\CityRepository;
use App\Http\Repositories\FilterRepository;
use App\Http\Repositories\Interfaces\AttributeRepositoryInterface;
use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Repositories\Interfaces\FilterRepositoryInterface;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\SupplierRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FilterRepositoryInterface::class, FilterRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $responseFactory)
    {
        $responseFactory->macro('api', function ($data = null, $message = "", $statusCode = 200) use ($responseFactory) {
            $customFormat = [
                'message' => $message,
                'payload' => $data,
            ];
            return $responseFactory->make($customFormat, $statusCode);
        });
    }
}
