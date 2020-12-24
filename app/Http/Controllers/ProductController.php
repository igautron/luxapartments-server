<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'status' => 'ok',
            'products' => Product::all(),
        ];
    }

    public function filter(Request $request)
    {
        $filter_values = json_decode($request->filter, true);

        $product = Product::where('id','>',1);

        if (isset($filter_values['categories'])) {
            $filter_categories = $filter_values['categories'];
            $product->where(function($q) use ($filter_categories){
                foreach ($filter_categories as $type => $one) {
                    $q->orWhere('category', $type);
                }
            });
        }

        if (isset($filter_values['areas'])) {
            $filter_areas = $filter_values['areas'];
            $product->where(function($q) use ($filter_areas){
                foreach ($filter_areas as $type => $one) {
                    $q->orWhere('area', $type);
                }
            });
        }

        $products = $product->offset(0)->limit(30)->get();
        
        return [
            'status' => 'ok',
            'filter_values' => $filter_values,
            'products' => $products,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
