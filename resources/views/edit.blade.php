@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        
                        <form action="{{ url('/book/update/'.$book->id) }}" enctype="multipart/form-data" method="post">

                            {{ csrf_field() }}

                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{ $book->name }}">
    
                            <label for="">Precio</label>
                            <input type="text" class="form-control" name="price" value="{{ $book->price }}">
    
                            <label for="">Cantidad</label>
                            <input type="text" class="form-control" name="amount" value="{{ $book->amount }}">
    
                            <label for="">Imagen</label>
                            <input type="file" class="form-control" name="image">
    
                            <button class="btn btn-success">editar</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection