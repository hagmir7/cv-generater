<div class="mt-3 d-none togels" id="skill-togel">
    <form action="{{ route('skill.create', $personel->id ) }}" method="POST" id="form-skill">
        @csrf
        <label for="skill">Skill</label>
        <input type="text" required class="form-control form-control-sm" name="skill" id="skill">
        <label for="langeuage-level" class="form-label mt-2">Level</label>
        <input type="range" name="level" class="form-control" class="form-range" id="langeuage-level">
        <button class="mt-3 btn btn-success btn-sm float-end w-25" id="add-skill">Save</button>
        <button class="mt-3 btn btn-success btn-sm float-end w-25 d-none" id="update-skill" type="button">Update</button>
    </form> 
    <table class="table table-hover">
        <thead @if(count($skills) == 0) class="d-none" @endif id="skill-thead">
          <tr>
            <th>Skill</th>
            <th>Level</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="skill-table">
            @foreach ($skills as $item)
            <tr id="{{ $item->id }}-skill">
                <td>{{ $item->skill }}</td>
                <td>{{ $item->level }} %</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-skill" onclick="loadeSkill({{ $item->id }})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteSkill({{ $item->id }})"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>