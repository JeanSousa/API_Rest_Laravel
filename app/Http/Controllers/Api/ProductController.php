<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index()
    {
        $products = $this->product->paginate(1);

        //quando uso o helper response ele já é uma instancia da classe response
        //e quando uso o método json de response ele já altera o header para json
        // como no exemplo =>  $response->header('Content-Type', 'application/json');
      
       // return response()->json($products);
       //product collection transforma a coleção inteira em json

       //product collection transforma a coleção products em json
       //o parametro products é transformado em json e aplicado ao atributo $this->collection
       return new ProductCollection($products);
    }

    public function show($id)
    {
        $product = $this->product->find($id);

       // return response()->json($product);

       return new ProductResource($product);
    }


    public function save(Request $request)
    {
        $data = $request->all();

        $product = $this->product->create($data);

        return response()->json($product);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $product = $this->product->find($data['id']);

        $product->update($data);

        return response()->json($product);
    }

    public function delete($id)
    {
        $product = $this->product->find($id);

        $product->delete();

        return response()
        ->json(['data' => ['msg' => 'Produto foi removido com sucesso!']]);
    }
}
