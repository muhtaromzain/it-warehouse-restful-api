<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
        
    }
    
    public function index() {
        
        $product = Product::select('id', 'name', 'brand', 'category', 'price', 'colour', 'condition', 'description')->get();
        return response()->json($product);

    }

    public function show($id) {

        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        return response()->json($product);

    }

    public function create(Request $request) {

        $this->validate($request ,[
            'name' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|integer',
            'colour' => 'required|string',
            'condition' => 'required|in:New,Used',
            'description' => 'string'
        ]);

        $data = $request->all();
        $product = Product::create($data);

        return response()->json($product);

    }

    public function update(Request $request, $id) {

        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        $this->validate($request ,[
            'name' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|integer',
            'colour' => 'required|string',
            'condition' => 'required|in:New,Used',
            'description' => 'string'
        ]);

        $data = $request->all();

        $product->fill($data);
        $product->save();

        return response()->json($product);
    }

    public function destroy($id) {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfuly!']);
    }

    private function findByInProduct($coloumn, $request) {
        
        $products = Product::select('id', 'name', 'brand', 'category', 'price', 'colour', 'condition', 'description')
                                ->where($coloumn, $request)
                                ->orWhere($coloumn, 'LIKE' , '%'.$request.'%')
                                ->get();

        return $products;
    }

    private function findBy($coloumn, $request) {

        $products = Product::select('id', 'name', 'brand', 'category', 'price', 'colour', 'condition', 'description')
                                ->where($coloumn, $request)
                                ->get();

        return $products;
    }

    public function findByBrand(Request $request) {

        $brand = $request->input('brand');
        $products = $this->findByInProduct('brand', $brand);
        
        if(!$products || $products->isEmpty()) {
            return response()->json(['message' => 'Products not found!'], 404);
        }

        return response()->json($products);

    }

    public function findByCategory(Request $request) {

        $category = $request->input('category');
        $products = $this->findBy('category', $category);

        if(!$products || $products->isEmpty()) {
            return response()->json(['message' => 'Categories not found!'], 404);
        }

        return response()->json($products);

    }

    public function findByCondition(Request $request) {

        $condition = $request->input('condition');
        $products = $this->findBy('condition', $condition);

        if(!$products || $products->isEmpty()) {
            return response()->json(['message' => 'Condition not found!'], 404);
        }

        return response()->json($products);

    }

    public function findByPriceRange(Request $request) {

        $from = $request->input('from');
        $to = $request->input('to');

        if (!$request->has('from') && !$request->has('to')) {
            return response()->json(['message' => 'Please insert price range'], 404);
        }
        else if(!$request->has('to')) {
            $products = Product::select('id', 'name', 'brand', 'category', 'price', 'colour', 'condition', 'description')
                            ->where('price', '>', $from)
                            ->get();

            if  (!$products || $products->isEmpty()) {
                return response()->json(['message' => 'Products within these price range are not found!'], 404);
            }

        }
        else if(!$request->has('from')) {
            $products = Product::select('id', 'name', 'brand', 'category', 'price', 'colour', 'condition', 'description')
                            ->where('price', '<', $to)
                            ->get();

            if  (!$products || $products->isEmpty()) {
                return response()->json(['message' => 'Products within these price range are not found!'], 404);
            }

        }
        else {
            $products = Product::select('id', 'name', 'brand', 'category', 'price', 'colour', 'condition', 'description')
                                ->whereBetween('price', [$from, $to])
                                ->get();

            if  (!$products || $products->isEmpty()) {
                return response()->json(['message' => 'Products within these price range are not found!'], 404);
            }
        }

        return response()->json($products);
    }

}
