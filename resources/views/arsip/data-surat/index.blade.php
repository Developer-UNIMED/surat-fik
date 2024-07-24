@extends('template.arsip')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $page }}</h6>
        </div>
        <div class="row gy-4 mt-1">
            <div class="col-xxl-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Jenis Surat</th>
                                <th scope="col">File Surat</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Prodi</th>
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

@section("js")
    <script>
        let table = new DataTable('#dataTable',
            {
                scrollX: true,
            }
        );

    </script>
@endsection
