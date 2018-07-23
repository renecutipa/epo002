@extends('books.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Libros</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('books.create') }}"> Nuevo</a>
                            </div>
                        </div>
                        <!-- Seccion de mensajes -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <!-- Fin de seccion de mensajes -->

                        <table class="table table-bordered">
                            <tr>
                                <th width="1%">No</th>
                                <th width="70px">Caratula</th>
                                <th>Titulo</th>
                                <th width="25%">Autores</th>
                                <th width="150px">Action</th>
                            </tr>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><img src="/images/{{$book->caratula}}" width="60" /></td>
                                <td>{{ $book->titulo }}</td>
                                <td>{{ $book->autores }}</td>
                                <td>
                                    <a class="btn btn-info" target="_blank" href="/pdfs/{{ $book->archivo}}">
                                        <i class="fa fa-eye"></i> 
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    <a class="btn btn-danger" href="{{route('book.delete', $book->id)}}?{{time()}}">
                                        <i class="fa fa-trash-o"></i> 
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <div class="row">
                         {!! $books->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection