<div class="mt-3 d-none togels" id="language-togel">
    <form action="{{ route('language.create', $personel->id ) }}" method="POST" id="form-language">
        @csrf
        <label for="language">Language</label>
        <input type="text" required class="form-control form-control-sm" name="language" id="language">
        <label for="langeuage-level" class="form-label mt-2">Level</label>
        <input type="range" name="level" class="form-control" class="form-range" id="langeuage-level">
        <button class="mt-3 btn btn-success btn-sm float-end w-25" id="add-language">Save</button>
        <button class="mt-3 btn btn-success btn-sm float-end w-25 d-none" id="update-language" type="button">Update</button>
    </form>
    <table class="table table-hover">
        <thead @if(count($languages) == 0) class="d-none" @endif id="langauge-thead">
          <tr>
            <th>Language</th>
            <th>Level</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="language-table">
            @foreach ($languages as $item)
            <tr id="{{ $item->id }}-language">
                <td>{{ $item->language }}</td>
                <td>{{ $item->level }} %</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-langauge" onclick="loadeLanguage({{ $item->id }})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteLanguage({{ $item->id }})"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>