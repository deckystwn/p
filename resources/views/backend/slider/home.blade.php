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
                        Advanced Table
                    </header><br>
                    <a href="{{ Route('slider.add') }}">
                        <button type="submit" class="btn btn-success btn-sm">Add Slider</button>
                    </a>
                        @if ($message = Session::get('success'))
                            <div class="col-lg-4">
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                    <table class="table table-striped table-advance table-hover">
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th><i class="icon_profile"></i> Title Slider</th>
                                <th><i class="icon_calendar"></i> Gambar</th>
                                <th><i class="icon_cogs"></i> Action</th>
                            </tr>
                            @foreach($post as $k)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $k->title_slider }}</td>
                                <td><img src="{{ asset('images/slider/'.$k->image) }}" alt="{{ $k->title_slider }}" width="100px"></td>
                                <td>
                                    <form action="{{ route('slider.destroy',$k->id) }}" method="post">

                                        <a class="btn btn-primary btn-sm" href="{{ route('slider.edit',$k->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <?php $count = count($post) ?>
                            @if(empty($count))
                                <td colspan="4" class="text-center">Data Slider Kosong</td>
                            @endif
                        </tbody>
                    </table>
                    <br>
                    <div class="d-flex justify-content-center">
                        {!! $post->links() !!}
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
      </section>
@endsection