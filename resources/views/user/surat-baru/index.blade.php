@extends('template.user')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $page }}</h6>
        </div>
        <div class="row gy-4 mt-1">
            <div class="col-xxl-12 col-xl-12">
                <div class="card basic-data-table">
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
                        <form action="{{ route('user.surat-baru.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Pilih Jenis Surat</label>
                                    <div class="position-relative">
                                        <select name="jenis_surat_id" id="jenis_surat" class="form-control">
                                            <option disabled selected>-- Pilih Jenis Surat --</option>
                                            @foreach ($data as $item)
                                                <option value="{{ $item['id'] }}" data-path="{{ $item['file_path'] }}">{{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Berkas Surat (File template surat yang sudah di edit oleh mahasiswa)</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('user.surat-baru.index') }}"><button type="button" class="btn btn-light">Kembali</button></a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
    </script>
@endsection
