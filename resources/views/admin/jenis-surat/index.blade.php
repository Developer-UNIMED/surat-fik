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
                                    <th scope="col">Nama Surat</th>
                                    <th scope="col">Format Surat</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['nama'] }}</td>
                                        <td>
                                            <a href="{{ str_replace('/public', '', asset($value['file_path'])) }}" target="_blank">
                                                <button class="btn btn-sm btn-info">Lihat</button>
                                            </a>
                                        </td>
                                        <td><img src="{{ str_replace('/public', '', asset($value['icon_path'])) }}" width="100px" height="100px" alt=""></td>
                                        <td>{{ $value['deskripsi'] }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" id="btnHapus" data-uuid="{{ $value['id'] }}"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="post" id="formHapus">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        let table = new DataTable('#dataTable');

        function generateDeleteUrl(id) {
            const endpoint = "{{ route('admin.jenis-surat.delete', '') }}";
            return `${endpoint}/${id}`;
        }

        $(document).on('click', '#btnHapus', function (e) {
            e.preventDefault();
            const id = $(this).attr('data-uuid');
            Swal.fire({
                icon: "question",
                title: "Yakin ingin menghapus data ini?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formHapus').attr('action', generateDeleteUrl(id)).submit();
                }
            });
        });
    </script>
@endsection
