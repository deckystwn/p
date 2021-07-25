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
            <?php $count = count($post) ?>
            @if (empty($count))
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <p>Data Alumni Kosong. Silahkan isi data kampus terlebih dahulu!</p>
                    </div>
                </div>
            @endif
            @foreach($post as $k)
                <div class="col-md-3 col-sm-2 col-xs-12">
                    <div class="thumbnail" style="width:80%;">
                        <a href="{{ route('alumni.home',$k->id) }}" >
                            <img src="{{ asset('images/kampus/'. $k->logo) }}" class="img-circle" style="width:100%; height:150px" alt="Lights" >
                            <div class="caption">
                                <button class="btn btn-primary btn-block">Data Alumni {{ $k->nama_kampus }}</button>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
      </section>
@endsection