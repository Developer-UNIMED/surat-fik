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
                        <div class="row gy-4">

                            @foreach($data as $index => $value)
                                @php
                                    $background = 'assets/images/user-grid/user-grid-bg'.rand(1, 12).'.png';
                                @endphp
                            <div class="col-xxl-3 col-md-6 user-grid-card">
                                <div class="position-relative border radius-16 overflow-hidden">
                                    <img src="{{ asset($background) }} " alt="" class="w-100 object-fit-cover">

                                    <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">

                                    </div>

                                    <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                        <img src="{{ asset(str_replace('/public', '', asset($value['icon_path']))) }} " alt="" style="width: 150px; height: 150px" class="border br-white border-width-2-px rounded-circle object-fit-cover">
                                        <h6 class="text-lg mb-0 mt-4">{{ $value['nama'] }}</h6>
                                        <span class="text-secondary-light mb-16"></span>

                                        <div class="position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                            <div class="text-center w-100">
                                                <h6 class="text-md mb-0">Deskripsi</h6>
                                                <span class="text-secondary-light text-sm mb-0">{{ $value['deskripsi'] }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ asset(str_replace('/public', '', asset($value['file_path']))) }}" target="_blank" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                            Download Format Surat
                                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
