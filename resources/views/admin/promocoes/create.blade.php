@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create New Promoco</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/promocoes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/promocoes') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.promocoes.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
