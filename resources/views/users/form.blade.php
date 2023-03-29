<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{isset($user) ? 'EDITAR REGISTRO' : 'CREAR REGISTRO'}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        <form action="{{ route(isset($user) ? 'users.update' : 'users.strore' ) }}" method="POST">
          <div class="mb-1">
              <input type="hidden" name = "id" class="form-control"  readonly value="{{isset($user) ? $user->id : null}}" >
            </div>
          <div class="mb-3">
            <label for="document" class="form-label">Documento</label>
            <input type="text" name = "document" class="form-control" value="{{isset($user) ? $user->document : null}}" placeholder="Documento">
        
          </div>
          <div class="mb-3">
            <label for="document" class="form-label">Tipo de Documento</label>
            <select class="selectpicker form-control" name="idDocumentsTypes" data-show-subtext="true" data-live-search="true">
              @foreach ($documentsTypes as $key=>$documentType)
                
                <option value="{{$key}}">{{$documentType}}</option>
                

              @endforeach
          </select>
          </div>

          <div class="mb-3">
            <label for="nickname" class="form-label">Nombre</label>
            <input type="text" name = "nickname" class="form-control" value="{{isset($user) ? $user->nickname : null}}" placeholder="Nombre">
          </div>
          @php
              //dd($user->UserRol);
              $rolesusuario =isset($user)? $user->UserRol->pluck('idRol')->toArray():[];
          @endphp
          <div class="mb-3">
            <label for="document" class="form-label">Cual es tu Rol</label>
            <select class="selectpicker form-control" multiple name="idRol[]" data-show-subtext="true" data-live-search="true">
              @foreach ($rols as $key=>$rol)
                @php
                    $selected = in_array($key,$rolesusuario);
                @endphp
                <option value="{{$key}}" @if($selected) selected @endif >{{$rol}}</option>
                

              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name = "email" class="form-control" value="{{isset($user) ? $user->email : null}}" placeholder="Correo Electronico">
        
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name = "password" class="form-control" value="{{isset($user) ? $user->password : null}}" placeholder="Contraseña">
        
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="button" class="btn btn-success" id="save-users">Guardar</button>
        </form>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>