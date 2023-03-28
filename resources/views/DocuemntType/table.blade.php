@foreach ($documentsTypes as $documentType)
<tr>
  <td>{{$documentType->id}}</td>
  <td>{{$documentType->name}}</td>
  <td>
      <button type="button" class="btn btn-info btn-sm edit-document-type mx-1" data-id="{{$documentType->id}}">
        <i class="bi bi-pencil-fill"></i>
      </button>

      <button type="button" class="btn btn-danger btn-sm mx-1 delete-document-type" data-id="{{$documentType->id}}" >
        <i class="bi bi-trash-fill"></i>
      </button>             
  </td>
</tr>
@endforeach
