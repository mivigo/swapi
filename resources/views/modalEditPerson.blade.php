@if (!empty($person))
        {!! Form::model($person, ['id'=>'editForm', 'method' => 'PATCH',
     'action'=>['PersonsController@update', $person->id],
     'class' => 'form-horizontal form-non-style person-edit', 'files' => true ]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Person {{$person->id}}</h4><br/>
            <span class="modal-title"> Details</span>
        </div>

        <div class="modal-content-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('height', 'Height: ') !!}
            {!! Form::text('height', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('hair_color', 'Hair Color: ') !!}
            {!! Form::text('hair_color', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('skin_color', 'Skin Color: ') !!}
            {!! Form::text('skin_color', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('eye_color', 'Eye Color: ') !!}
            {!! Form::text('eye_color', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('birth_year', 'Birth Year: ') !!}
            {!! Form::text('birth_year', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('gender', 'Gender: ') !!}
            {!! Form::text('gender', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('homeworld', 'Homeworld: ') !!}
            {!! Form::text('homeworld', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('species', 'Species: ') !!}
            {!! Form::text('species', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('vehicles', 'Vehicles: ') !!}
            {!! Form::text('vehicles', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-content-group">
            {!! Form::label('starships', 'Starships: ') !!}
            {!! Form::text('starships', null, ['class' =>'form-control']) !!}
        </div>

        <div class="modal-footer">
            <button
                    type="submit" class="btn btn-cyan btn-primary">
                <i class="fa fa-2 fa-cog fa-spin"></i>&nbsp;
                Save Changes
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
@endif
<style>
    .form-non-style {
        width: auto !important;
        margin: 0 auto;
    }
</style>

{!! Form::close() !!}