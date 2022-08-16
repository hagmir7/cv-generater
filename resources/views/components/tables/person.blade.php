<div class="mt-3 togels" id="personel-togel">
    <form action="{{ route('cv.update', $personel->id ) }}" method="POST" id="form-personel" enctype="multipart/form-data">
        @csrf
        <div  class="d-flex justify-content-center">
            @if (!empty($personel->avatar))
            <label for="avatar">
                <img src="/Image/{{ $personel->avatar }}" alt="" id="avatar-view" style="height: 100px; width:100px" class="avatar cover text-cetner">
            </label>
            @else
            <label for="avatar">
                <img src="" alt="" id="avatar-view" style="height: 100px; width:100px" class="cover avatar d-none text-cetner">
                <div class="rounded-pill border text-cetner px-4 py-4 avatar-placeholder"><i class="bi bi-camera px-1"></i></div>
            </label>
            @endif
        </div>
        <input type="file" name="avatar" id="avatar" accept="image/*" class="d-none form-control form-control-sm my-2">
        <div class="input-group mt-3">
            <input required value="{{ $personel->first_name }}"  type="text" name="first_name" id="first_name" class="form-control from-control-sm" placeholder="First name"> 
            <input required value="{{ $personel->last_name }}" type="text" name="last_name" id="last_name" class="form-control from-control-sm" placeholder="Last name"> 
        </div> 

        <div class="input-group mt-2">
            <input required value="{{ $personel->cin }}" type="text" name="cin" id="cin" class="form-control from-control-sm" placeholder="CIN"> 
            <input required value="{{ $personel->email }}" type="email" name="email" id="email" class="form-control from-control-sm" placeholder="Email"> 
        </div>

        <div class="input-group mt-2">
            <input required value="{{ $personel->phone }}" type="tel" name="phone" id="phone" class="form-control from-control-sm" placeholder="Phone"> 
            <input required value="{{ $personel->address }}" type="text" name="address" id="address" class="form-control from-control-sm" placeholder="Address"> 
        </div>
        <div class="input-group mt-2">
            <input required value="{{ $personel->city }}" type="text" name="city" id="city" class="form-control from-control-sm" placeholder="City"> 
            <input required value="{{ $personel->zip }}" type="number" name="zip" id="zip" class="form-control from-control-sm" placeholder="ZIP"> 
        </div>
        <label for="job" class="mt-2">Your job</label>
    <input type="text" value="{{ $personel->job}}" name="job" id="job" class="form-control form-control-sm" placeholder="Excerpt about you..." required maxlength="30">
        <label for="bio" class="mt-2">Excerpt</label>
        <textarea name="bio" id="bio" cols="30" rows="3" required maxlength="160" class="form-control">{{ $personel->bio}}</textarea>
        <button class="btn btn-sm btn-success float-end my-3 w-25 " id="add-personel" type="submit">Save</button>
    </form>
</div>