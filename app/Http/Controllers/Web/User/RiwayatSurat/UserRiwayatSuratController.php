<?php

namespace App\Http\Controllers\Web\User\RiwayatSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuratMasukService;
use App\Services\ValidasiSuratService;

class UserRiwayatSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private SuratMasukService $service)
    {
    }


    public function index()
    {
        $page = "Riwayat Surat";
        $data = $this->service->findAllByUserId(auth()->id());
        return view("user.riwayat-surat.index", compact("page", "data"));
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
