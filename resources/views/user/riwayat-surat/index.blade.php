@extends('template.user')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $page }}</h6>
        </div>
        <div class="row gy-4 mt-1">
            <div class="col-xxl-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-body">
                        @php
                            function convertTimestamp($timestamp) {
                                // Convert the timestamp to a DateTime object
                                $date = new DateTime($timestamp);

                                // Format the date to 'd-m-Y'
                                return $date->format('d - m - Y');
                            }
                        @endphp
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Surat</th>
                                <th scope="col">Posisi Surat</th>
                                <th scope="col">Tanggal Pengajuan</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value['jenis_surat'] }}</td>
                                    <td>{{ $value['penerima_role_id'] }}</td>
                                    <td>{{ convertTimestamp($value['created_at'])  }}</td>
                                    <td>{{ $value['status'] }}</td>
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
