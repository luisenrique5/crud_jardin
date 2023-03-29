@foreach ($users as $user)
  <tr>
    <td>{{$user->document}}</td>
    <td>{{$user->DocumentType->name}}</td>
    <td>{{$user->nickname}}</td>
    <td>
      <ul>
      @foreach ($user->UserRol as $rol)
        <li>{{$rol->idRol}} {{$rol->name}}</li>
      @endforeach
     </ul>
    </td>
    <td>{{$user->email}}</td>
    <td>
        <button type="button" class="btn btn-info btn-sm edit-users mx-1" data-id="{{$user->id}}">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>

        <button type="button" class="btn btn-danger btn-sm mx-1 delete-users" data-id="{{$user->id}}" >
          <i class="fa fa-trash-o" aria-hidden="true"></i>
        </button>             
    </td>
  </tr>
@endforeach