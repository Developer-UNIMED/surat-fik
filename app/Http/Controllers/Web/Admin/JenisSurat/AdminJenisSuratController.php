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
    public function __construct(private readonly JenisSuratService $jenisSuratService)
    {
    }

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

        $jenisSurat = $this->jenisSuratService->create(array_merge([
            'id' => $id,
            'file_path' => $filePath,
            'icon_path' => $iconPath,
        ], $form));

        return response()->json([$jenisSurat->toArray(),
            Storage::url($jenisSurat->icon_path)]);
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
