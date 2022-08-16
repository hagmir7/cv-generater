<div class="mt-3 d-none togels" id="experience-togel">
    <form action="{{ route('experience.create', $personel->id ) }}" method="POST" id="form-experience">
        @csrf
        <div class="row mt-2">
            <div class="col-6">Experience</div>
            <div class="col-6">Company name</div>
        </div>
        <div class="input-group">
            <input class="form-control form-control-sm" placeholder="Experience" required type="text" name="experience" id="experience">
            <input class="form-control form-control-sm" required placeholder="Company" type="text" name="company" id="company">
        </div>
        <div class="row mt-2">
            <div class="col-6">Start date</div>
            <div class="col-6">End date</div>
        </div>
        <div class="input-group">
            <input class="form-control form-control-sm" required type="date" name="start_date" id="start_date">
            <input class="form-control form-control-sm" type="date" name="end_date" id="end_date">
        </div>
        <label for="city mt-2">City</label>
        <input class="form-control form-control-sm" placeholder="City..." required type="text" name="city" id="city-experience">
        <label for="description">Description</label>
        <textarea name="description" id="experienc-description" placeholder="Description" required cols="30" rows="3" class="form-control mt-2"></textarea>
        <button class="mt-3 btn btn-success btn-sm float-end w-25" id="add-experience">Save</button>
        <button class="mt-3 btn btn-success btn-sm float-end w-25 d-none" id="update-experience" type="button">Update</button>
    </form>
    <table class="table table-hover">
        <thead @if(count($experiences) == 0) class="d-none" @endif id="experienc-thead">
          <tr>
            <th>Experience</th>
            <th>Company</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="experience-table">
            @foreach ($experiences as $item)
            <tr id="{{ $item->id }}-table">
                <td>{{ $item->experience }}</td>
                <td>{{ $item->company }}</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-experience" onclick="loadeExperience({{ $item->id }})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteExperience({{ $item->id }})"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>