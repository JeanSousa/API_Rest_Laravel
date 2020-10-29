<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

//resource collection server para transformar a coleção inteira em json
//não somente um objeto em json
class ProductCollection extends ResourceCollection  
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'data' => $this->collection
        ];
    }

    //metodo with deixa uma informação extra para o endpoint de forma separada
    public function with($request)
    {
        return [
            'extra_information' => 'Another data!',
            'extra'             => 'Dado adicional'
        ];
    }
}
