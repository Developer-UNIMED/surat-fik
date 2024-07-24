<?php

namespace App\Http\Controllers\Web\Admin\ValidasiSurat;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisSuratStoreRequest;
use App\Http\Requests\Admin\AdminValidasiSuratRequest;
use Illuminate\Http\Request;
use App\Services\ValidasiSuratService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminValidasiSuratController extends Controller
{
    public function __construct(private readonly ValidasiSuratService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Validasi Surat";
        $data = $this->service->findAllSuratMasukByRolePenerima(auth()->user()->role);
        $validator = $this->service->findAllPenerimaSuratRole();
        return view("admin.surat-masuk.index", compact("page", 'data', 'validator'));
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
    public function store(AdminValidasiSuratRequest $request)
    {
        $form = $request->validated();
        $suratMasukId = $form['surat_masuk_id'];
        $roleId = $form['role_id'];

        $forwardSurat = $this->service->forwardSurat($suratMasukId, $roleId);

        return redirect()->route("admin.surat-masuk.index")->with([
            "code" => 201,
            "status" => "OK",
            "message" => "Surat Berhasil Diteruskan.",
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
    public function delete(string $id)
    {
        //
    }
}
