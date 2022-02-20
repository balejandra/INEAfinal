<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermisoZarpeController extends Controller
{

    public function index()
    {

       // $products = Product::all();

        return view('zarpes.permiso_zarpe.index');
    }

    public function createStepOne(Request $request)
    {
     /*   $product = $request->session()->get('product');

        return view('products.create-step-one',compact('product'));*/
    }


    public function permissionCreateStepOne(Request $request)
    {
    /*    $validatedData = $request->validate([
            'name' => 'required|unique:products',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        if(empty($request->session()->get('product'))){
            $product = new Product();
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }else{
            $product = $request->session()->get('product');
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }

        return redirect()->route('products.create.step.two');*/
    }


    public function createStepTwo(Request $request)
    {
        /*$product = $request->session()->get('product');

        return view('products.create-step-two',compact('product'));*/
    }


    public function permissionCreateStepTwo(Request $request)
    {
       /* $validatedData = $request->validate([
            'stock' => 'required',
            'status' => 'required',
        ]);

        $product = $request->session()->get('product');
        $product->fill($validatedData);
        $request->session()->put('product', $product);

        return redirect()->route('products.create.step.three');*/
    }


    public function createStepThree(Request $request)
    {
     /*   $product = $request->session()->get('product');

        return view('products.create-step-three',compact('product'));*/
    }

    public function permissionCreateStepThree(Request $request)
    {
       /* $product = $request->session()->get('product');
        $product->save();

        $request->session()->forget('product');

        return redirect()->route('products.index');*/
    }



}
