<?php

namespace App\Http\Middleware\admin;

use Closure;
use App\Common\Traits\UpdateCacheTrait;

class UpdateCacheMiddleware {
    use UpdateCacheTrait;

    public function handle($request, Closure $next, $type) {
        $response = $next($request);
        switch ($type) {
            case 'category':
                $this->updateCategories(1);
                $this->updateCategories();
                $this->updateResources();
                break;
            case 'category_properties':
                $this->updateCatePropRelation();
        }
        return $response;
    }
}