<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TIPO DE DOCUMENTOS</title>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">VISTA DE USUARIOS</a>
          </button>
            <div class="nav navbar-nav">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <h5>
                    <a class="navbar-brand" aria-current="page" href="/public"> 
                      <i class="fa fa-user-circle" aria-hidden="true"></i>
                        Usuarios
                    </a>
                  </h5>
                </li>
                <li class="nav-item">
                 <h5>
                    <a class="navbar-brand" aria-current="page" href="/public/DocumentType">
                      <i class="fa fa-address-book" aria-hidden="true"></i>
                        Tipos De Documentos
                    </a>
                  </h5>
                </li>
                <li class="nav-item">
                  <h5>
                     <a class="navbar-brand" aria-current="page" href="/public/Roles">
                      <i class="fa fa-address-card-o" aria-hidden="true"></i>
                         Roles
                     </a>
                   </h5>
                 </li>                
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <br>
      <br>
      <br>
      <br>
      <div class="card border-0 shadow">
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @if (Session::has('message'))
              <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
        @endif
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Documento</th>
                <th>Tipo Documento</th>
                <th>Nombre</th>
                <th>Roles</th>
                <th>Correo</th>
                <th>
                  
                    Acciones
                    <button type="button" class="btn btn-primary" id="create-users">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </button>
                  
                </th>
              </tr>
            </thead>
            <tbody id="table-users">

            </tbody>
          </table>
          <div id="form-container">
          </div>
        </div>
      </div>
    </div>

    

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/loading/loading.js') }} " type="text/javascript"></script> 
    <script src="{{ asset('js/users.js?') }} {{ time() }}" type="text/javascript"></script>    
  </body>
</html>