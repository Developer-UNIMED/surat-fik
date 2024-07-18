<?php

namespace App\Http\Controllers\Web\Admin\JenisSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminJenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Jenis Surat";
        return view("admin.jenis-surat.index", compact("page"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = "Tambah Data Jenis Surat";
        return view("admin.jenis-surat.create", compact("page"));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
