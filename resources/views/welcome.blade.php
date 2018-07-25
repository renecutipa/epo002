<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <body>
        
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ISEPA</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            @if (Route::has('login'))
                    @if (Auth::check())
                        <li><a href="{{ url('/books') }}">Panel de Control</a></li>
                    @else
                        <li><a href="{{ url('/login') }}">Ingresar</a></li>
                    @endif
            @endif
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>REPOSITORIO</h1>
        <p>Bienvenidos al Repositorio Institucional del ISEPA, cuyo objetivo es facilitar y mejorar la visibilidad de la producción cientifica y académica, permitiendo el acceso abierto a sus contenidos y garantizando la preservación y conservación de dicha producción, además de aumentar el impacto del legado Institucional.</p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
          <form class="form-inline">
                <input name="q" class="form-control input-lg" type="text" placeholder="Texto a buscar..." aria-label="Buscar">
                <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-search"></i> Buscar</button>
            </form>
      </div>
      <hr/>
      @if($searchedBooks != null)

      <h3>Resultados de busqueda: "{{$q}}"</h3>
        @if(!$searchedBooks->isEmpty())
        <table class="table">
            <tr>
                <th width="40px"></th>
                <th>Titulo</th>
                <th width="25%">Autores</th>
                <th width="20"></th>
            </tr>
            @foreach ($searchedBooks as $book)
            <tr>
                <td><img src="/images/{{$book->caratula}}" width="40" /></td>
                <td>{{ $book->titulo }}</td>
                <td>{{ $book->autores }}</td>
                <td>
                  <a class="btn btn-info" target="_blank" href="/pdfs/{{ $book->archivo}}">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>          
            </tr>
            @endforeach
        </table>
        @else
        {{"No se econtraron resultados"}}
        @endif
      @endif
      <hr/>
      <div class="row">
        <h3>Últimos Ingresos</h3>
        @foreach ($books as $book)
        <div class="col-md-2">
          <p><img src="/images/{{$book->caratula}}" width="100%" height="220px" /></p>
          <p><a class="btn btn-default" href="/pdfs/{{$book->archivo}}" target="_blank" role="button">Vista Previa »</a></p>
        </div>
        @endforeach
        
      </div>

      <hr>

      <footer>
        <p>© 2018 AYTANA</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    </body>
</html>
