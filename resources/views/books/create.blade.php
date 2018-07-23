@extends('books.layout')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Nuevo Libro</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('books.index') }}"> Atrás</a>
                            </div>
                        </div>
                    </div>

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

                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Titulo:</strong>
                                    <input type="text" name="titulo" class="form-control">
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Autores:</strong>
                                    <input type="text" name="autores" class="form-control">
                                    <small>Ejemplo: Perez, Juan; Lopez, Jorge</small>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Descripción:</strong>
                                    <textarea class="form-control" name="descripcion"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Caratula:</strong>
                                    <input type="file" name="caratula" class="form-control">
                                    <small>La imagen del documento que se desea mostrar.</small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Archivo:</strong>
                                    <input type="file" name="archivo" class="form-control">
                                    <small>Archivo PDF del documento.</small>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>

                        {{ csrf_field() }}
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection