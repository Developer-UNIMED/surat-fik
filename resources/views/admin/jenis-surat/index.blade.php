@extends('template.admin')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $page }}</h6>
        </div>
        <div class="row gy-4 mt-1">
            <div class="col-xxl-12 col-xl-12">
                <div class="card basic-data-table">
                    <div class="card-header">
                        <a href="{{ route('admin.jenis-surat.create') }}">
                            <button type="button" class="btn rounded-pill btn-success-600 px-20 py-11 d-flex align-items-center gap-2">
                                <iconify-icon icon="ion:add-circle" class="text-xl"></iconify-icon> Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Surat</th>
                                    <th scope="col">Format Surat</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        let table = new DataTable('#dataTable');
    </script>
@endsection
