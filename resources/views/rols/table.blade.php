@foreach ($rols as $rol)
<tr>
  <td>{{$rol->id}}</td>
  <td>{{$rol->name}}</td>
  <td>
      <button type="button" class="btn btn-info btn-sm edit-rols mx-1" data-id="{{$rol->id}}">
        <i class="bi bi-pencil-fill"></i>
      </button>

      <button type="button" class="btn btn-danger btn-sm mx-1 delete-rols" data-id="{{$rol->id}}" >
        <i class="bi bi-trash-fill"></i>
      </button>             
  </td>
</tr>
@endforeach
