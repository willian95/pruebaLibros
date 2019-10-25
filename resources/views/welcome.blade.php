@extends('layouts.main')

@section('content')

    
    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if(Session::has('success'))

                    <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                    </div>
                    
                @endif

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
                        
                        <form action="{{ url('/book/store') }}" enctype="multipart/form-data" method="post">

                            {{ csrf_field() }}

                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="name">
    
                            <label for="">Precio</label>
                            <input type="text" class="form-control" name="price">
    
                            <label for="">Cantidad</label>
                            <input type="text" class="form-control" name="amount">
    
                            <label for="">Imagen</label>
                            <input type="file" class="form-control" name="image">
    
                            <button class="btn btn-success">Agregar</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->price }}</td>
                                <td>{{ $book->amount }}</td>
                                <td><img src="{{ asset('/'.$book->image) }}" alt="" style="width: 60px;"></td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('/book/edit/'.$book->id) }}">Actualizar</a>
                                    <button class="btn btn-danger" onclick="erase({{ $book->id }})">Eliminar</button>
                                    <form method="post" action="{{ url('book/delete/'.$book->id) }}" id="delete_form_{{ $book->id }}">
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>


@endsection

@section('js')

    <script>
        
        function erase(id){
            if(confirm('Está seguro de eliminar')){
                $("#delete_form_"+id).submit()
            }
        }
        
    </script>

@endsection
