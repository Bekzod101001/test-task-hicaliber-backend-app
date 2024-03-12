<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedItemsResource extends JsonResource
{
    public static $wrap = null;

    public $itemsResourceWrapper;

    public function __construct($resource, $itemsResourceWrapper = null)
    {
        parent::__construct($resource);
        $this->itemsResourceWrapper = $itemsResourceWrapper;
    }

    public function toArray($request)
    {
        return [
            'total' => $this->total(),
            'totalPages' => $this->lastPage(),
            'current' => $this->currentPage(),
            'items' => $this->itemsResourceWrapper ? $this->itemsResourceWrapper::collection($this->items()) : $this->items(),
        ];

    }
}
