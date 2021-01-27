<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class MealCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toResponse($request)
    {
        $paginated = $this->resource->toArray();
        $json = array_merge_recursive(
            [ 'meta' => [
                
                'currentPage' => $paginated['current_page'],
                'totalItems' => $this->total(),
                'itemsPerPage' => $this->perPage(),
                'totalPages' => $this->lastPage(),
                ]
            ],

            [
                'data' => $this->collection,
            ], 

            ['links' => [    
                'prev' => $paginated['prev_page_url'] ?? null,
                'next' => $paginated['next_page_url'] ?? null,
                'self' => request()->fullUrlWithQuery([]) ?? null
                ]
            ]                           
        );
        return response()->json($json,200,[],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
