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
                        <form class="form-horizontal" role="form" action="{{ route('kampus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kampus" class="col-lg-2 control-label">Nama Kampus</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="nama_kampus" name="nama_kampus" placeholder="Nama Kampus">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-lg-2 control-label">Logo Kampus</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" id="logo" name="logo">
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