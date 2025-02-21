<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view("product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function buy(Product $product)
    {
        $client = new Client();

        if (Auth::user()->customer) {
            $response = $client->request('POST', 'https://api-sandbox.asaas.com/v3/payments', [
                'body' => json_encode([
                    'billingType' => 'UNDEFINED',
                    'customer' => Auth::user()->customer->customer,
                    'value' => $product->price,
                    'dueDate' => date('Y-m-d'),
                    'description' => $product->name,
                    'externalReference' => $product->id,
                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => env("ASAAS_ACCESS_TOKEN"),
                    'content-type' => 'application/json',
                ]
            ]);

            dd($response->getBody());
        }

        $response = $client->request('POST', 'https://api-sandbox.asaas.com/v3/customers', [
            'body' => json_encode([
                'name' => Auth::user()->name,
                'cpfCnpj' => '276.648.650-00',
                'email' => Auth::user()->email,
            ]),
            'headers' => [
                'accept' => 'application/json',
                'access_token' => env("ASAAS_ACCESS_TOKEN"),
                'content-type' => 'application/json',
            ]
        ]);

        dd($response->getBody());
    }
}
