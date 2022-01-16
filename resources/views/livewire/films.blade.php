@extends('home')
@section('content')
<div>
    <h3>All Films</h3>

    <table class="table  table-hover">
        @if($films!=null)
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Opening crawl</th>
                <th>Director</th>
                <th>Producer</th>
                <th>Release date</th>
                <th>Characters</th>
                <th>Planets</th>
                <th>Starships</th>
                <th>Vehicles</th>
                <th>Species</th>
                <th>Show people</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $key=>$film)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $film->title }}</td>
                <td>{{ $film->opening_crawl }}</td>
                <td>{{ $film->director }}</td>
                <td>{{ $film->producer }}</td>
                <td>{{ $film->release_date }}</td>
                <td>@foreach ($film->people as $key=>$people)
                    <p>{{$people->url}}</p>
                    @endforeach
                </td>
                <td>@foreach ($film->planets as $key=>$planet)
                    <p>{{$planet->url}}</p>
                    @endforeach
                </td>
                <td>@foreach ($film->starships as $key=>$starship)
                    <p>{{$starship->title}}</p>
                    @endforeach
                </td>
                <td>@foreach ($film->vehicles as $key=>$vehicle)
                    <p>{{$vehicle->title}}</p>
                    @endforeach
                </td>
                <td>@foreach ($film->species as $key=>$species)
                    <p>{{$species->title}}</p>
                    @endforeach
                </td>
                <td> <a type="button" class="btn" href="{{ url('films/'.$film->id) }}">Show people</a></td>
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
@endsection