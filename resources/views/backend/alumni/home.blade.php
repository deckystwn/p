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
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Data Alumni {{ $kampus->nama_kampus }}
                    </header><br>
                    <a href="{{ Route('alumni.add',$kampus->id) }}">
                        <button type="submit" class="btn btn-success btn-sm">Add Alumni</button>
                    </a>
                        @if ($message = Session::get('success'))
                            <div class="col-lg-4">
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                    <table class="table table-hover table-responsive">
                        <tbody>
                            <tr>
                                <th></i> Foto</th>
                                <th></i> Nama Lengkap</th>
                                <th></i> Jenis Kelamin</th>
                                <th></i> Alamat</th>
                                <th></i> Jurusan</th>
                                <th></i> Fakultas</th>
                                <th></i> Angkatan</th>
                                <th></i> Alumni</th>
                                <th></i> Nomor WhatsApp</th>
                                <th></i> Akun Instaram</th>
                                <th><i class="icon_cogs"></i> Action</th>
                            </tr>
                            @foreach($alumni as $a)
                                <tr>
                                    <td><img src="{{ asset('images/alumni/'.$a->foto) }}" alt="{{ $a->nama_lengkap }}" width="50px"></td>
                                    <td>{{ $a->nama_lengkap }}</td>
                                    <td>{{ $a->jenis_kelamin }}</td>
                                    <td>{{ $a->alamat }}</td>
                                    <td>{{ $a->jurusan }}</td>
                                    <td>{{ $a->fakultas }}</td>
                                    <td>{{ $a->angkatan }}</td>
                                    <td>{{ $a->alumni }}</td>
                                    <td>{{ $a->no_wa }}</td>
                                    <td>{{ $a->akun_ig }}</td>
                                    <td>
                                        <form action="{{ route('alumni.destroy',$a->id) }}" method="post">

                                            <a class="btn btn-primary btn-sm" href="{{ route('alumni.edit',$a->id) }}">Edit</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <?php $count = count($alumni) ?>
                            @if(empty($count))
                                <td colspan="4" class="text-center">Data Alumni Kosong</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $alumni->links() }}
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
      </section>
@endsection