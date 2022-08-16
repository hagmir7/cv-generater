<div class="mt-3 d-none togels" id="diplome-togel">
    <form action="{{ route('diplome.create', $personel->id) }}" method="POST" id="form-diplome">
        @csrf
        <div class="row mt-2">
            <div class="col-6"><label for="diplome">Diplome</label></div>
            <div class="col-6"><label for="establishment">Establishment</label></div>
        </div>
        <div class="input-group">
            <input type="text" required class="form-control form-control-sm" name="diplome" id="diplome">
            <input type="text" required class="form-control form-control-sm" name="establishment" id="establishment">
        </div>
        <div class="row mt-2">
            <div class="col-6"><label for="city">City</label></div>
            <div class="col-6"><label for="date_obtained">Date obtained</label></div>
        </div>
        <div class="input-group">
            <input type="text" required class="form-control form-control-sm" name="city" id="city-diplome">
            <input type="date" required class="form-control form-control-sm" name="date_obtained" id="date_obtained">
        </div>
        <label for="description" class="mt-2">Description</label>
        <textarea name="description" id="description-diplome" class="form-control" cols="30" rows="3"></textarea>
        <button class="mt-3 btn btn-success btn-sm float-end w-25" id="add-diplome">Save</button>
        <button class="mt-3 btn btn-success btn-sm float-end w-25 d-none" id="update-diplome" type="button">Update</button>

    </form>
    <table class="table table-hover">
        <thead @if(count($diplomes) == 0) class="d-none" @endif id="diplome-thead">
          <tr>
            <th>Diplome</th>
            <th>Establishment</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="diplome-table">
            @foreach ($diplomes as $item)
            <tr id="{{ $item->id }}-diplome">
                <td>{{ $item->diplome }}</td>
                <td>{{ $item->establishment }}</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-diplome" onclick="loadeDiplome({{ $item->id }})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteDiplome({{ $item->id }})"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>