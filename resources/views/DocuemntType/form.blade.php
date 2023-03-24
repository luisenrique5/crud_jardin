
<form action="{{ route('documentType.store') }}" method="POST">
    <div class="mb-1">
        <label for="id" class="form-label">Id</label>
        <input type="text" name = "id" class="form-control" disabled readonly value="{{isset($documentsType) ? $documentsType->id : null}}" >
      </div>
    <div class="mb-3">
      <label for="name" class="form-label">Tipo De Documento</label>
      <input type="text" name = "name" class="form-control" {{isset($documentsType) ? $documentsType->name : null}}>
      <div id="emailHelp" class="form-text">Ingresa aqui el nuevo tipo de documento.</div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-success">Crear</button>
</form>  