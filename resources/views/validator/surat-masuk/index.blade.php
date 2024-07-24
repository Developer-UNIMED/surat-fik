@extends('template.validator')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $page }}</h6>
        </div>
        <div class="row gy-4 mt-1">
            <div class="col-xxl-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>- {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('message'))
                            @if(session('status') == 'OK')
                                <div class="alert alert-success mt-4">
                                    <div class="alert-text">
                                        <h4 class="alert-heading">Success</h4>
                                        <p>{{ session('message') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-danger mt-4">
                                    <div class="alert-text">
                                        <h4 class="alert-heading">Error</h4>
                                        <p>{{ session('message') }}</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Jenis Surat</th>
                                <th scope="col">File Surat</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $surat)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $surat['author'][0] }}</td>
                                    <td>{{ $surat[3] }}</td>
                                    <td>
                                        <a target="_blank" href="{{ str_replace('/public', '', asset($surat[2])) }}">
                                            <button class="btn btn-sm btn-info">Lihat</button>
                                        </a>
                                    </td>
                                    <td>{{ $surat['author'][3] }}</td>
                                    <td>{{ $surat['author'][2] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm rounded-pill btn-success-600 px-20 py-11 d-flex align-items-center gap-2" id="btnTerima" data-mahasiswa="{{ $surat['author'][0] }}" data-jenis-surat="{{ $surat[3] }}" data-uuid="{{ $surat[0] }}">
                                            <iconify-icon icon="ion:checkmark-circle" class="text-xl"></iconify-icon>Terima
                                        </button>
                                        <button type="button" class="btn btn-sm rounded-pill btn-warning-600 px-20 py-11 d-flex align-items-center gap-2 mt-8">
                                            <iconify-icon icon="ion:close-circle" class="text-xl"></iconify-icon>Tolak
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Surat?</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('validator.store') }}" method="post" id="formKonfirmasi">
                        @csrf
                        <input type="hidden" id="modalUuidSuratMasuk" name="surat_masuk_id">
                        <div class="row gy-3">
                            <div class="col-sm-12">
                                <label class="form-label">Nama Mahasiswa</label>
                                <div class="position-relative">
                                    <p id="modalNamaMahasiswa"></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Jenis Surat</label>
                                <div class="position-relative">
                                    <p id="modalJenisSurat"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" form="formKonfirmasi" class="btn btn-primary">Ya, konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let table = new DataTable('#dataTable',
            {
                scrollX: true,
            }
        );

        $('#btnTerima').on('click', function() {
            $('#modalKonfirmasi').modal('show');
            $('#modalNamaMahasiswa').text($(this).data('mahasiswa'));
            $('#modalJenisSurat').text($(this).data('jenis-surat'));
            $('#modalUuidSuratMasuk').val($(this).data('uuid'));
        });
    </script>
@endsection
