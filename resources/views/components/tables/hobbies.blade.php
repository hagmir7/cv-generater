<div class="mt-3 d-none togels" id="hobby-togel">
    <form action="{{ route('hobby.create', $personel->id ) }}" method="POST" id="form-hobby">
        @csrf
        <label for="hobby">Hobby</label>
        <input type="text" required class="form-control form-control-sm" name="hobby" id="hobby">
        <button class="mt-3 btn btn-success btn-sm float-end w-25" id="add-hobby">Save</button>
        <button class="mt-3 btn btn-success btn-sm float-end w-25 d-none" id="update-hobby" type="button">Update</button>
    </form>
    <table class="table table-hover">
        <thead @if(count($hobbies) == 0) class="d-none" @endif id="hobby-thead">
          <tr>
            <th>hobby</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="hobby-table">
            @foreach ($hobbies as $item)
            <tr id="{{ $item->id }}-hobby">
                <td>{{ $item->hobby }}</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-hobby" onclick="loadeHobby({{ $item->id }})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteHobby({{ $item->id }})"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>