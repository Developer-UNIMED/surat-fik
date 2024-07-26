<?php

namespace App\Http\Controllers\Web\Validator\SuratMasuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Validator\ValidatorValidasiRequest;
use App\Services\ValidasiSuratService;

class ValidatorSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private readonly ValidasiSuratService $service)
    {
    }

    public function index()
    {
        $page = "Surat Masuk";
        $data = $this->service->findAllSuratMasukByRolePenerima(auth()->user()->role);
        return view("validator.surat-masuk.index", compact("page", "data"));
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
    public function store(ValidatorValidasiRequest $request)
    {
        $form = $request->validated();
        $suratMasukId = $form['surat_masuk_id'];

        $forwardSurat = $this->service->archiveSurat($suratMasukId, "ARSIP");

        return redirect()->route("validator.index")->with([
            "code" => 201,
            "status" => "OK",
            "message" => "Surat Berhasil Diterima.",
        ]);
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
