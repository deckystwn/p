@extends('backend.default')

@push('meta')
    <meta name="author" content="">
    <meta name="keywords" content="si alumni,alumni,sialumni">
    <meta name="description" content="Website Alumni"/>
@endpush

@push('title')
    <title>Admin | sialumni</title>
@endpush

@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-8">
                <section class="panel">
                    <header class="panel-heading">
                        Data Kampus
                    </header>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" action="{{ route('alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT');
                            <div class="form-group">
                                <label for="foto" class="col-lg-2 control-label">Kampus</label>
                                <div class="col-lg-10">
                                    <select name="kampus_id" id="kampus_id" class="form-control">
                                        <option value="{{ $alumni->kampus_id }}" selected>{{ $alumni->kampus_id }}</option>
                                        @foreach($kampus as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kampus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="col-lg-2 control-label">Foto Alumni</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_lengkap" class="col-lg-2 control-label">Nama Lengkap</label>
                                <div class="col-lg-10">
                                    <input type="text" value="{{ $alumni->nama_lengkap }}" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Kampus">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-lg-2 control-label">Jenis Kelamin</label>
                                <div class="col-lg-10">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option selected value="{{ $alumni->jenis_kelamin }}">{{ $alumni->jenis_kelamin }}</option>
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-lg-2 control-label">Alamat</label>
                                <div class="col-lg-10">
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control">{{ $alumni->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jurusan" class="col-lg-2 control-label">Jurusan</label>
                                <div class="col-lg-10">
                                    <input type="text" value="{{ $alumni->jurusan }}" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fakultas" class="col-lg-2 control-label">Fakultas</label>
                                <div class="col-lg-10">
                                    <input type="text" value="{{ $alumni->fakultas }}" class="form-control" id="fakultas" name="fakultas" placeholder="Fakultas">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="angkatan" class="col-lg-2 control-label">Angkatan</label>
                                <div class="col-lg-10">
                                    <input type="number" value="{{ $alumni->angkatan }}" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alumni" class="col-lg-2 control-label">Alumni</label>
                                <div class="col-lg-10">
                                    <input type="text" value="{{ $alumni->alumni }}" class="form-control" id="alumni" name="alumni" placeholder="Alumni">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_wa" class="col-lg-2 control-label">No WhatsApp</label>
                                <div class="col-lg-10">
                                    <input type="number" value="{{ $alumni->no_wa }}" class="form-control" id="no_wa" name="no_wa" placeholder="No WhatsApp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="akun_ig" class="col-lg-2 control-label">Akun Instagram</label>
                                <div class="col-lg-10">
                                    <input type="text" value="{{ $alumni->akun_ig }}" class="form-control" id="akun_ig" name="akun_ig" placeholder="@sialumni">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection