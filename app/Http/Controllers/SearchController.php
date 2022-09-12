<?php

namespace App\Http\Controllers;

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
            ->search($request->value);

        return $searchResults->groupByType();
    }
}
