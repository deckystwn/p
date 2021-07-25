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
                        Data User
                    </header>
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
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                            @foreach($post as $k)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $k->name }}</td>
                                <td>{{ $k->email }}</td>
                                <td>{{ $k->username }}</td>
                                <td>
                                    <form action="{{ route('user.destroy',$k->id) }}" method="post">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <?php $count = count($post) ?>
                            @if(empty($count))
                                <td colspan="4" class="text-center">Data User Kosong</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $post->links() !!}
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
      </section>
@endsection