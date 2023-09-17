<?php

namespace App\Http\Controllers;

use App\Models\GoogleConfigServices;
use Illuminate\Http\Request;

class GoogleConfigServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $service = new GoogleConfigServices();
        $service->name = $request->name;
        $service->client_id = $request->client_id;
        $service->client_secret = $request->client_secret;
        $service->code = $request->code;
        $service->token = $request->token;
        $service->expires_at = $request->expires_at;
        $service->save();
        return $service;
    }

    /**
     * Display the specified resource.
     */
    public function show(GoogleConfigServices $googleConfigServices)
    {
        return $googleConfigServices;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoogleConfigServices $googleConfigServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GoogleConfigServices $googleConfigServices)
    {        
        $googleConfigServices->name = $request->name ?? $googleConfigServices->name;
        $googleConfigServices->client_id = $request->client_id ?? $googleConfigServices->client_id;
        $googleConfigServices->client_secret = $request->client_secret ?? $googleConfigServices->client_secret;
        $googleConfigServices->code = $request->code ?? $googleConfigServices->code;
        $googleConfigServices->token = $request->token ?? $googleConfigServices->token;
        $googleConfigServices->expires_at = $request->expires_at ?? $googleConfigServices->expires_at;
        $googleConfigServices->save();
        return $googleConfigServices;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoogleConfigServices $googleConfigServices)
    {
        //
    }

    /**
     * Display specific resource by name.
     */
    public function showByName($name) {
        return GoogleConfigServices::where('name', $name)->first();
    }
}
