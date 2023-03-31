<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{isset($rol) ? 'EDITAR REGISTRO' : 'CREAR REGISTRO'}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" id="modal-body">
        <form action="{{ route(isset($rol) ? 'rols.update' : 'rols.store' ) }}" method="POST">
          <div class="mb-1">
              <input type="hidden" name = "id" class="form-control"  readonly value="{{isset($rol) ? $rol->id : null}}" >
            </div>

          <div class="mb-3">
            <label for="name" class="form-label">Tipo De Rol</label>
            <input type="text" name = "name" class="form-control" value="{{isset($rol) ? $rol->name : null}}" placeholder="Ingresa aqui el nuevo Rol">
        
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="button" class="btn btn-success" id="save-rols">Guardar</button>
        </form>          
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>