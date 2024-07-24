<?php

namespace App\Http\Controllers\Web\Arsip\DataSurat;

use App\Http\Controllers\Controller;
use App\Services\ValidasiSuratService;
use Illuminate\Http\Request;

class ArsipDataSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private readonly ValidasiSuratService $service)
    {
    }


    public function index()
    {
        $page = "Data Surat";
        $data = $this->service->findAllSuratMasukByRolePenerima(auth()->user()->role);
        return view("arsip.data-surat.index", compact("page", 'data'));
    }
}
