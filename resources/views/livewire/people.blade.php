@include('home')
<div class=" m-5">
    <h3>All Film's №{{$film->id}} people</h3>

    <table class="table  table-hover" cellspacing="0" width="100%">
        @if($film!=null)
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Height</th>
                <th>Mass</th>
                <th>Hair color</th>
                <th>Skin color</th>
                <th>Eye color</th>
                <th>Birth year</th>
                <th>Gender</th>
                <th>Homeworld</th>
                <th>Films</th>
                <th>Species</th>
                <th>Starships</th>
                <th>Vehicles</th>
                <th>url</th>
                <th>created</th>
                <th>edited</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($film->people as $key=>$people)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $people->name }}</td>
                <td>{{ $people->height }}</td>
                <td>{{ $people->mass }}</td>
                <td>{{ $people->hair_color }}</td>
                <td>{{ $people->skin_color }}</td>
                <td>{{ $people->eye_color }}</td>
                <td>{{ $people->birth_year }}</td>
                <td>{{ $people->gender }}</td>
                <td>{{ $people->homeworld }}</td>
                <td>@foreach ($people->films as $key=>$film)
                    <p>{{$film->url}}</p>
                    @endforeach
                </td>
                <td>@foreach ($people->species as $key=>$species)
                    <p>{{$species->title}}</p>
                    @endforeach
                </td>
                <td>@foreach ($people->starships as $key=>$starship)
                    <p>{{$starship->title}}</p>
                    @endforeach
                </td>
                <td>@foreach ($people->vehicles as $key=>$vehicle)
                    <p>{{$vehicle->title}}</p>
                    @endforeach
                </td>
                <td>{{ $people->url }}</td>
                <td>{{ $people->created }}</td>
                <td>{{ $people->edited }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <span class="text-danger">No data available! Save data first!</span>
            </tr>
            @endif
        </tbody>
    </table>
</div>