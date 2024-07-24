<?php

namespace App\Http\Controllers\Web\User\SuratBaru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AkademikUser;
use App\Http\Requests\User\SuratMasukRequest;
use App\Services\SuratMasukService;
use App\Services\JenisSuratService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSuratBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private SuratMasukService $service, private JenisSuratService $jenisSuratService)
    {
    }

    public function index()
    {
        $page = "Buat Surat Baru";
        $data = $this->jenisSuratService->findAll();
        return view("user.surat-baru.index", compact("page", "data"));
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
    public function store(SuratMasukRequest $request)
    {
        $form = $request->validated();
        $uploadPath = 'public/surat_masuk';
        $id = Str::ulid();
        $jurusan = auth()->user()->akademik->jurusan;

        $filePath = Storage::putFileAs(
            path: $uploadPath, file: $form['file'],
            name: "$id-file." . $form['file']->extension());

        $suratMasuk = $this->service->create($jurusan ,array_merge([
            'id' => $id,
            'file_path' => $filePath,
        ], $form));

        return redirect()->route("user.surat-baru.index")->with([
            "code" => 201,
            "status" => "OK",
            "message" => "Surat berhasil dibuat.",
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
