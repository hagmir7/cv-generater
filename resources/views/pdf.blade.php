<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <style>


        *{
            font-family: source sans pro, -apple-system, BlinkMacSystemFont, segoe ui, Roboto, helvetica neue, Arial, sans-serif, apple color emoji, segoe ui emoji, segoe ui symbol;
        }

        body{
            width: 700px;
        }

        .header{
            height: 200px;
            background-color: #00a4fd;
            display:table;

        }


        .avatar{
            width: 30%;
            /* width: 100%; */
            height: 200px;
            background-image: url({{ public_path('/Image/'. $cv->avatar) }});
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
        .excerpt{
            width: 70%;
            padding-left: 15px
        }

        .progress{
            background-color: blue;
            color: white;
            width: 100%;
            padding: 0;
            text-align: center;
            border-radius: 12px;
            font-size: 10px;
        }
        .left{
            background-color: #f2f1f1;
            width: 50%;
            padding: 5px;
        }

        .right{
            width: 50%;
            padding: 5px;
        }

        img{
            /* object-fit: cover; */
             height: 200px;
        }

        
        .avatar-bg{

        }

        td{
            vertical-align: top
        }

        .page-break {
            page-break-after: always;
        }

        .headers{
            margin: 0
        }


    </style>
</head>
  <body>


    <table>
        <tbody>
            <tr class="header">
                <td class="avatar">
                    {{-- <img src="/Image/{{ $cv->avatar }}" width="100%" alt=""> --}}
                    {{-- <div class="avatar-bg">
                        <img width="100%" src="{{ public_path('/Image/'. $cv->avatar) }}" >
                    </div> --}}
                </td>

                {{-- Caption --}}
                <td class="excerpt">
                    <h1 style="margin: 0;color:#344767;">{{ $cv->first_name }} {{ $cv->last_name }}</h1>
                    <h3 style="margin: 0;color:#344767;">{{ $cv->job }}</h3>
                    <p>{{ $cv->bio }}</p>
                </td>
            </tr>

        </tbody>
    </table>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td class="left">
                    <h2 class="headers">Contact</h2>
                    <ul style="list-style: none; padding:0;margin:5px">
                        <li>{{ $cv->email }}</li>
                        <li>{{ $cv->phone }}</li>
                        <li>{{ $cv->city }}, {{ $cv->address }}</li>
                        <li>{{ $cv->cin }}</li>
                        <li>{{ $cv->zip }}</li>
                    </ul>
                    {{-- Skill --}}
                    <h2 class="headers">Skills</h2>
                    @foreach ($cv->skill as $skill)
                    <div>
                        <h5 class="headers">{{ $skill->skill }}</h5>
                         <div class="progress" style="width: {{ $skill->level }}%"> <small>{{ $skill->level }}%</small></div>
                    </div>    
                    @endforeach


                    {{-- Language --}}
                    <h2 class="headers">Languages</h2>
                    @foreach ($cv->language as $lang)
                    <div>
                        <h5 class="headers">{{ $lang->language }}</h5>
                         <div class="progress" style="width: {{ $lang->level }}%""> <small>{{ $lang->level }}%</small></div>
                    </div>
                    @endforeach
                 {{-- Qualities --}}
                <h2 class="headers">Qualities</h2>
                <ul style="list-style:none; margin:0;padding:5px;">
                    <li style="margin: 0 0 12px 5px">- Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident, iusto! adipisicing elit. Provident, iusto!</li>
                    <li style="margin: 0 0 12px 5px">- Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident, iusto! adipisicing elit. Provident, iusto!</li>
                    <li style="margin: 0 0 12px 5px">- Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident, iusto! adipisicing elit. Provident, iusto!</li>
                </ul>
                </td>



                <td class="right">
                    {{-- Experience --}}
                    <h2 class="headers">Experience</h2>
                    @foreach ($cv->experience as $exper)
                    <div>
                        <h4 class="headers">Web Development <br> <small style="float: right;">12-03-2020 / 12-03-2020</small><br></h4>
                        <p style="margin: 0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident, iusto! adipisicing elit. Provident, iusto!</p>
                    </div>       
                    @endforeach
                    <hr>
                    {{-- Education --}}
                    <h2 class="headers">Education</h2>

                    @foreach ($cv->diplome as $diplome )
                    <div>
                        <h4 class="headers">{{ $diplome->diplome }} at {{ $diplome->establishment }} <br> <small style="float: right;">{{ $diplome->date_obtained }} </small><br></h4>
                        <p style="margin: 0">{{ $diplome->description }} </p>
                    </div> 
                    @endforeach
                    <hr>
                    {{-- Hobbies --}}
                    <h2 class="headers">Hobbies</h2>
                    <ul style="list-style: none">
                        @foreach ($cv->hobby as $hobby)
                            <li>{{ $hobby->hobby }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>

    </div>
  </body>
</html>