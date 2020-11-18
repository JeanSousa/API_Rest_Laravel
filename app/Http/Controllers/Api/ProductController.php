<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index(Request $request)
    {
        $products = $this->product;

        //pega uma instancia da model sem os filtros
        $productRepository = new ProductRepository($products);

        //conditions=name:X;price=x
        if ($request->has('conditions')) {
            $productRepository->selectConditions($request->get('conditions'));
        }

 
        if ($request->has('fields')) {
            $productRepository->selectFilter($request->get('fields'));
        }

        //quando uso o helper response ele já é uma instancia da classe response
        //e quando uso o método json de response ele já altera o header para json
        // como no exemplo =>  $response->header('Content-Type', 'application/json');
      
       // return response()->json($products);
       //product collection transforma a coleção inteira em json

       //product collection transforma a coleção products em json
       //o parametro products é transformado em json e aplicado ao atributo $this->collection
       return new ProductCollection($productRepository->getResult()->paginate(10));
    }

    public function show($id)
    {
        $product = $this->product->find($id);

       // return response()->json($product);

       return new ProductResource($product);
    }


    public function save(ProductRequest $request)
    {
        $data = $request->all();

        $product = $this->product->create($data);

        return response()->json($product);
    }

    public function update(ProductRequest $request)
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
