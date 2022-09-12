<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Package;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {

        $searchResults = (new Search())
            ->registerModel(User::class, function(ModelSearchAspect $modelSearchAspect) use ($request) {
                $modelSearchAspect
                    ->addSearchableAttribute('first_name')
                    ->addSearchableAttribute('last_name')
                    ->addSearchableAttribute('email')
                    ->addSearchableAttribute('phone')
                    ->addSearchableAttribute('address')
                    ->select("id", "first_name", "last_name", "email", "phone", "address");
                    })
            ->registerModel(Supplier::class, function(ModelSearchAspect $modelSearchAspect) use ($request) {
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('email')
                    ->addSearchableAttribute('phone')
                    ->addSearchableAttribute('address')
                    ->select("id", "name", "email", "phone", "address");
            })
            ->registerModel(Product::class, function(ModelSearchAspect $modelSearchAspect) use ($request) {
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('unit_code')
                    ->addSearchableAttribute('price')
                    ->select("id", "name", "unit_code", "price");
            })
            ->registerModel(Package::class, function(ModelSearchAspect $modelSearchAspect) use ($request) {
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('unit_code')
                    ->addSearchableAttribute('price')
                    ->select("id", "name", "unit_code", "price");
            })
            ->registerModel(Courier::class, function(ModelSearchAspect $modelSearchAspect) use ($request) {
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('email')
                    ->addSearchableAttribute('price')
                    ->select("id", "name", "email", "price");
            })
            ->search($request->value);

        return $searchResults->groupByType();
    }
}
