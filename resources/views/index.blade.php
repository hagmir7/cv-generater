@extends('layout.layout')


@section('content')
<style>
.cv-list-card{
    height: 200px;
}    

.progress-bar-sm{
    height: 9px;
    font-size: 8px;
}

.cv-headers-text{
    font-size: 13px!important;
    padding: 0;
    margin: 0;
}
}

.cv-header{

}
.job-text-sm{

}

.cv-avatar-sm{
    width: 100px;
    height: 112px;
}

.text-bio{
    font-size: 9px!important;
}

.text-normal{
    font-size: 10px!important;
}

.text-description-sm{
    line-height: 9px!important;
}

.options-list{
    position: absolute;
    z-index: 12;
    display: flex;
    justify-content: space-around;
    width: 100%;
    padding-left: 12px;
    padding-right: 12px;
    background: #0000009e;
    color: white;
    left: 0;
}

a{
    text-decoration: none!important;
}



/* .dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
} */

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;


}

.dropdown-content a {
  display: block;
  transition: 2s;
}

.dropdown:hover .dropdown-content {display: block;transition: 2s;}

</style>
<div class="container-fluid">
    <div class="row mt-2">
        @foreach ($resume as  $cv)
        <div class="col-12 col-md-6 col-lg-4 dropdown">
            <div class="row m-2 border shadow-sm rounded overflow-hidden position-relative dropbtn">
                <div class="dropdown-content ">
                    <ul class="p-2 options-list animate__animated animate__flipInX animate__fast">
                        <li><a href="{{ route('cv.create', $cv->slug ) }}" class="text-white">Update</a></li>
                        <li>Download</li>
                        <li><a href="{{ route('cv.delete', $cv->id )}}" class="text-white" onclick="confirm('Are you sur you want to delete CV...')">Delete</a></li>
                    </ul>
                </div>
                <div class="overflow-hidden col-12 d-flex mb-0 p-0" style="background: linear-gradient(rgb(33, 200, 246), rgb(99, 123, 255));height: 112px;">
                    <div class="">
                        @if ($cv->avatar)
                         <img src="/Image/{{ $cv->avatar }}" alt="{{ $cv->first_name }}" class="cover cv-avatar-sm">
                        @else
                        <img src="/assets/img/default.webp" alt="" class="cover cv-avatar-sm">
                        @endif
                    </div>
                    <div class="mt-1 mx-4 d-flex  w-100 h-100">
                        <div class="text-white">
                            <h1 class="h2 cv-headers-text"><span class="first_name">{{ $cv->first_name }}</span> <span class="last_name">{{ $cv->last_name }}</span></h1>
                            <h3 class="h6 job text-normal" >{{ $cv->job }}</h3>
                            <p class="bio text-bio">{{ $cv->bio }}</p>
                        </div>
                    </div>
                </div>
                <div class="row pe-0">
                    <div class="col-6 bg-light m-0 pb-2">
                        <h4 class="mt-2 them-blue cv-headers-text m-0">Contact</h4>
                        @if ($cv->email)
                        <ul class= "text-muted text-normal p-1">
                            <li class="my-1"><i class="bi bi-envelope"></i> &#xa0; <span class="email">{{ $cv->email }}</span></li>
                            <li class="my-1"><i class="bi bi-telephone"></i> &#xa0; <span class="phone">{{ $cv->phone }}</span></li>
                            <li class="my-1"><i class="bi bi-geo-alt"></i> &#xa0; <span class="city">{{ $cv->city }}</span>, <span class="address">{{ $cv->address }}</span></li>
                            <li class="my-1"><i class="bi bi-hash"></i> &#xa0; <span class="cin">{{ $cv->cin }}</span></li>
                            <li class="my-1"><i class="bi bi-mailbox"></i> &#xa0; <span class="zip">{{ $cv->zip }}</span></li>
                        </ul> 
                        @endif
                        <h4 class="mt-2 them-blue cv-headers-text m-0">Skills</h4>
                        <div class="skills text-muted">
                            @foreach ($cv->skill as $skill)
                                <div>
                                    <h6 class="m-0 text-normal"><small>{{ $skill->skill}}</small></h6>
                                    <div class="progress progress-bar-sm">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{ $skill->level}}%;" aria-valuenow="{{ $skill->level}}" aria-valuemin="0" aria-valuemax="100">{{ $skill->level}}%</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
            
                        <h4 class="mt-2 them-blue cv-headers-text m-0">Languages</h4>
                        <div class="languages text-muted">
                            @foreach ($cv->language as $item)
                            <div>
                                <h6 class="m-0 text-normal"><small dir="auto">{{ $item->language }}</small></h6>
                                <div class="progress progress-bar-sm">
                                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{ $item->level }}%;" aria-valuenow="{{ $item->level }}" aria-valuemin="0" aria-valuemax="100">{{ $item->level }}%</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
            
                    </div>
                    <div class="col-6 m-0 p-1">
                        {{-- Experience --}}
                        <h4 class="them-blue cv-headers-text">Experience</h4>
                        <div class="experience">
                            @foreach ($cv->experience as $item)
                            <div>
                                <h6 class="m-0 them-blue-text text-normal">{{ $item->experience }} <br>  <small class="d-flex justify-content-end text-normal ">{{ $item->start_date }} / {{ $item->end_date }}</small></h6>
                                <div class="text-description-sm"><small class="text-muted text-justify text-normal">{{ $item->description }}</small></div>
                            </div>
                            @endforeach
                        </div>
                        <hr class="m-1">
                        {{-- Education --}}
                        <h4 class="them-blue cv-headers-text">Education</h4>
                        <div class="diplome">
                            @foreach ($cv->diplome as $item)
                                <div>
                                    <h6 class="m-0 them-blue-text text-normal">{{ $item->diplome }} at {{ $item->establishment }} <br> <small class="d-flex justify-content-end text-normal">{{ $item->date_obtained }}</small></h6>
                                    <div class="text-description-sm"><small class="text-muted text-normal">{{ $item->description }}</small></div>
                                </div>
                            @endforeach
                        </div>
                        <hr class="m-1">
                        <h4 class="them-blue cv-headers-text">Hobbies</h4>
                        <ul class="hobbies text-muted p-0">
                            @foreach ($cv->hobby as $hobby)
                                <li class="text-normal">- {{ $hobby->hobby }} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>



@endsection