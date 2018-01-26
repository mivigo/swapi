<!DOCTYPE html>
<html lang="en">
<head>
    <title>Persons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.common.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>
</head>
<body>
<div class="container">
    <div class=class="col-sm">
        <h2>Persons Table</h2>
        <a href="{{url('/')}}/getdata" onclick="return confirm('Get all Persons?');" type="button" class="btn btn-primary">Download data to DB</a>
    </div>
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
            <th>Action</th>
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
                    <a href="{{url('/')}}/persons/{{ $value->id }}/edit"
                       data-id="1"
                       data-toggle="modal"
                       data-target="#editPerson"
                       class="btn btn-primary btn-xs click-action"
                       title="Edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a onclick="deletePerson({{ $value->id }})"
                       data-toggle="tooltip"
                       data-placement="top"
                       class='btn btn-danger btn-xs click-action'
                       title='Delete'>
                        <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $persons->links() }}

    @include ('emptyModal', ['name' => 'editPerson'])
</div>
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deletePerson(id) {
        var appUrl = '{{url('/')}}';
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(isConfirm) {
            if (isConfirm) {
                return new Promise(function () {
                    $.ajax({
                        type: "POST",
                        data:{
                            _token: '{{ csrf_token() }}',
                            _method:"DELETE"
                        },
                        url: appUrl + '/persons/' + id,
                        success: function () {
                            swal({
                                timer: 1000,
                                text: 'Deleted!',
                                type: "success"
                            });
                            $('.' + num).css('display', 'none');
                        },
                        error: function (data) {
                            swal({
                                timer: 1000,
                                text: "ERROR " + "Something went wrong",
                                type: "error"
                            });
                        }
                    });
                });
            }
        })
        }
    </script>
@stop

@yield('scripts')

@include ('emptyModal', ['name' => 'editPerson'])

</body>
</html>

