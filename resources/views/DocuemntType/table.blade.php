@foreach ($documentsTypes as $documentType)
<tr>
  <td>{{$documentType->id}}</td>
  <td>{{$documentType->name}}</td>
  <td>
      <button type="button" class="btn btn-info btn-sm edit-document-type mx-1" data-id="{{$documentType->id}}">
        <i class="bi bi-pencil-fill"></i>
      </button>

      <form action="{{ route('documentType.destroy', $documentType) }}" method="POST" style="display: unset;">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" value="Eliminar" class="btn btn-danger btn-sm mx-1" onclick="return confirm('¿Desea eliminar...?')">
            <i class="bi bi-trash-fill"></i>
          </button>
      </form>              
  </td>
</tr>
@endforeach