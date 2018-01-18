<!DOCTYPE html>
<html lang="en">
<head>
    <title>Persons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Persons Table</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Height</th>
            <th>Hair Color</th>
            <th>Skin Color</th>
            <th>Eye Color</th>
            <th>Birth Year</th>
            <th>Gender</th>
            <th>Homeworld</th>
            <th>Species</th>
            <th>Vehicles</th>
            <th>Starships</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($persons as $key => $value)
            <tr class=" @if($value->id % 2 == 0): success @else danger @endif ">
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->height }}</td>
                <td>{{ $value->hair_color }}</td>
                <td>{{ $value->skin_color }}</td>
                <td>{{ $value->eye_color }}</td>
                <td>{{ $value->birth_year }}</td>
                <td>{{ $value->gender }}</td>
                <td>
                    <a href="@if(isset($value->homeworld)) {{ $value->homeworld }} @endif">Home</a>
                </td>
                <td>
                    <?php $species = json_decode($value->species); $i = 0; ?>
                    @foreach($species as $item)
                        <?php $i+=1; ?>
                            @if (count($species) > 1)
                                <a href=" {{ $item }}">Species # {{ $i }}</a>
                            @else <a href=" {{ $item }}">Species</a>
                            @endif
                    @endforeach
                </td>
                <td>
                    <?php $vehicles = json_decode($value->vehicles); $i = 0; ?>
                    @foreach($vehicles as $item)
                        <?php $i+=1; ?>
                        @if (count($vehicles) > 1)
                            <a href=" {{ $item }}">Vehicles # {{ $i }}</a>
                        @else <a href=" {{ $item }}">Vehicles</a>
                        @endif
                    @endforeach
                </td>
                <td>
                    <?php $starships = json_decode($value->starships); $i = 0; ?>
                    @foreach($starships  as $item)
                        <?php $i+=1; ?>
                        @if (count($starships ) > 1)
                            <a href=" {{ $item }}">Starships # {{ $i }}</a>
                        @else <a href=" {{ $item }}">Starships</a>
                        @endif
                    @endforeach
                </td>
                <td>
                    {{--<a href="{{ env('APP_URL') }}/leads/id"--}}
                    {{--data-id="id"--}}
                    {{--data-toggle="modal"--}}
                    {{--data-target="#viewPerson"--}}
                    {{--class="btn btn-success btn-xs click-action"--}}
                    {{--title="Overview">--}}
                    {{--<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>--}}
                    {{--</a>--}}

                    <a href="{{ env('APP_URL') }}/persons/id/edit"
                       data-id="1"
                       data-toggle="modal"
                       data-target="#editPerson"
                       class="btn btn-primary btn-xs click-action"
                       title="Edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a id='iddeleteLeadnum' onclick='deleteButton(this.id)'
                       data-urltodelete='leads' data-num='id' data-id='{id'
                       class='btn btn-danger btn-xs click-action'
                       title='Delete'>
                        <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @include ('emptyModal', ['name' => 'editPerson'])
</div>

</body>
</html>

