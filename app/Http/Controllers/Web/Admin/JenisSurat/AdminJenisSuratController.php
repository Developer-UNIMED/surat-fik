<?php

namespace App\Http\Controllers\Web\Admin\JenisSurat;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisSuratStoreRequest;
use App\Services\JenisSuratService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminJenisSuratController extends Controller
{
    public function __construct(private readonly JenisSuratService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Jenis Surat";
        $data = $this->service->findAll();
        return view("admin.jenis-surat.index", compact("page", "data"));
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
    public function store(JenisSuratStoreRequest $request)
    {
        $form = $request->validated();
        $uploadPath = 'public/jenis_surat';
        $id = Str::ulid();

        $iconPath = Storage::putFileAs(
            path: $uploadPath, file: $form['icon'],
            name: "$id-icon." . $form['icon']->extension());

        $filePath = Storage::putFileAs(
            path: $uploadPath, file: $form['file'],
            name: "$id-file." . $form['file']->extension());

        $jenisSurat = $this->service->create(array_merge([
            'id' => $id,
            'file_path' => $filePath,
            'icon_path' => $iconPath,
        ], $form));

        return redirect()->route("admin.jenis-surat.index")->with([
            "code" => 201,
            "status" => "OK",
            "message" => "Data berhasil ditambahkan.",
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
        $id = $this->service->delete($id);
        if (!$id) {
            $error = "Gagal Menghapus Data, Data Tidak Ditemukan";
            return redirect()->back()->with([
                "code" => 404,
                "status" => "NOT_FOUND",
                "message" => $error
            ]);
        }

        return redirect()->route("admin.jenis-surat.index")->with([
            "code" => 200,
            "status" => "OK",
            "message" => "Berhasil menghapus data",
        ]);
    }
}
