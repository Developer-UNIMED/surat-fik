@extends('template.admin')

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
                        <form action="{{ route('admin.jenis-surat.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Nama Jenis Surat</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Nama Jenis Surat" name="nama" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Format Surat</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Icon Surat</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control" name="icon" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Icon Surat</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Surat (Opsional)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.jenis-surat.index') }}"><button type="button" class="btn btn-light">Kembali</button></a>
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
