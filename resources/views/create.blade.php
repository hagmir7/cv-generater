@extends('layout.layout')



@section('content')
<div class="container-fluid">
    <div class="row"> 
        <div class="col-6 border">
            <div class="mt-3 p-1 border rounded-pill d-flex justify-content-center">
                <button class="btn bg-gradient-info shadow-none btn-sm px-2 rounded-pill m-1 personel-togel togel-btn" onclick="display('personel-togel')">Personel</button>
                <button class="btn bg-gradient-default shadow-none btn-sm px-2 rounded-pill m-1 experience-togel togel-btn" onclick="display('experience-togel')">Experiences</button>
                <button class="btn bg-gradient-default shadow-none btn-sm px-2 rounded-pill m-1 language-togel togel-btn" onclick="display('language-togel')">Languages</button>
                <button class="btn bg-gradient-default shadow-none btn-sm px-2 rounded-pill m-1 skill-togel togel-btn" onclick="display('skill-togel')">Skills</button>
                <button class="btn bg-gradient-default shadow-none btn-sm px-2 rounded-pill m-1 quality-togel togel-btn" onclick="display('quality-togel')">Qualities</button>
                <button class="btn bg-gradient-default shadow-none btn-sm px-2 rounded-pill m-1 hobby-togel togel-btn" onclick="display('hobby-togel')">Hobbies</button>
                <button class="btn bg-gradient-default shadow-none btn-sm px-2 rounded-pill m-1 diplome-togel togel-btn" onclick="display('diplome-togel')">Diplomes</button>
            </div>


            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger my-2 p-2">{{ $error }}</div>
                @endforeach
            @endif

            @include('components.tables.person')
            @include('components.tables.experiences')
            @include('components.tables.skills')
            @include('components.tables.langauges')
            @include('components.tables.hobbies')
            @include('components.tables.diplomes')


        </div>
    
        <div class="col-6 mb-3">
            <div class="row col-12 d-flex mb-0 p-0 " style="background: linear-gradient(rgb(33, 200, 246), rgb(99, 123, 255)); height: 200px;">
                <div class="col-4 p-0 m-0">
                    @if ($personel->avatar )
                    <img src="/Image/{{ $personel->avatar }}" alt="" width="200px" height="200px" class="cover avatar-view-cv">
                    @else
                    <img src="/assets/img/default.webp" alt="" width="200px" height="200px" class="cover avatar-view-cv">
                    @endif
                </div>
                <div class="col-8">
                    <div class="text-white">
                        <h1 class="h2"><span class="first_name">{{ $personel->first_name }}</span> <span class="last_name">{{ $personel->last_name }}</span></h1>
                        <h3 class="h6 job" >{{ $personel->job}} </h3>
                        <p class="bio text-sm">{{ $personel->bio }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 bg-light py-2">
                    <h5 class="them-blue m-0">Contact</h5>
                    <ul class= "text-muted text-sm p-2 m-0">
                        <li class="my-1"><i class="bi bi-envelope"></i> &#xa0; <span class="email">{{ $personel->email }}</span></li>
                        <li class="my-1"><i class="bi bi-telephone"></i> &#xa0; <span class="phone">{{ $personel->phone }}</span></li>
                        <li class="my-1"><i class="bi bi-geo-alt"></i> &#xa0; <span class="city">{{ $personel->city }}</span>, <span class="address">{{ $personel->address }}</span></li>
                        <li class="my-1"><i class="bi bi-hash"></i> &#xa0; <span class="cin">{{ $personel->cin }}</span></li>
                        <li class="my-1"><i class="bi bi-mailbox"></i> &#xa0; <span class="zip">{{ $personel->zip }}</span></li>
                    </ul>
                    <h5 class="them-blue m-0">Skills</h5>
                    <div class="skills text-muted">
                        @foreach ($skills as $skill)
                            <div id="{{ $skill->id}}-skill-cv">
                                <h6 class="m-0"><small>{{ $skill->skill}}</small></h6>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{ $skill->level}}%;" aria-valuenow="{{ $skill->level}}" aria-valuemin="0" aria-valuemax="100">{{ $skill->level}}%</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <h5 class="mt-2 them-blue m-0">Languages</h5>
                    <div class="languages text-muted">
                        @foreach ($languages as $item)
                        <div id='{{ $item->id }}-language-cv'>
                            <h6 class="m-0"><small dir="auto">{{ $item->language }}</small></h6>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{ $item->level }}%;" aria-valuenow="{{ $item->level }}" aria-valuemin="0" aria-valuemax="100">{{ $item->level }}%</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
    
                </div>
                <div class="col-6 py-2">
                    {{-- Experience --}}
                    <h5 class="them-blue m-0">Experience</h5>
                    <div class="experience">
                        @foreach ($experiences as $item)
                        <div id="{{ $item->id }}-cv">
                            <h6 class="m-0 them-blue-text text-sm">{{ $item->experience }} <br>  <small class="float-end ">{{ $item->start_date }} / {{ $item->end_date }}</small></h6><br>
                            <div><small class="text-muted text-justify">{{ $item->description }}</small></div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="m-1">
                    {{-- Education --}}
                    <h5 class="them-blue m-0">Education</h5>
                    <div class="diplome">
                        @foreach ($diplomes as $item)
                            <div id="{{ $item->id }}-diplome-cv" >
                                <h6 class="m-0 them-blue-text">{{ $item->diplome }} at {{ $item->establishment }} <br> <small class="float-end ">{{ $item->date_obtained }}</small></h6><br>
                                <div class="text-justify"><small class="text-muted">{{ $item->description }}</small></div>
                            </div>
                        @endforeach
                    </div>
                    <hr class="m-1">
                    <h5 class="them-blue m-0">Hobbies</h5>
                    <ul class="hobbies text-muted text-sm">
                        @foreach ($hobbies as $hobby)
                            <li id="{{ $hobby->id }}-hobby-cv">- {{ $hobby->hobby }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>



    
@endsection