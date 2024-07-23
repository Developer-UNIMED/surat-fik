<?php

namespace App\Http\Controllers\Web\User\TemplateSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JenisSuratService;

class UserTemplateSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private JenisSuratService $service)
    {
    }

    public function index()
    {
        $page = "Template Surat";
        $data = $this->service->findAll();
        return view("user.template-surat.index", compact("page", "data"));
    }

}
