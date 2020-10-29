<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) //metodo to array contem o array que sera convertido em json
    {
        //chama o atributo name do produto passado como parametro no product controller
        return [
            'name' => $this->name,
            'price' => $this->price,
            'slug' => $this->slug
        ];

        // return $this->resource->toArray();
    }

    //No product resource tambem se pode usar o metodo 'with'
    //pois o método é extendido da classe JsonResource
    //sera um dado extra para um resource ou seja retorno unico diferente do collection
    //obs = SE TIVER DADO EXTRA O LARAVEL NÃO REMOVE O WRAP
    public function with($request)
    {
        return [
            'extra-single-data' => 'Retornar nesta chamada...'
        ];
    }
}
