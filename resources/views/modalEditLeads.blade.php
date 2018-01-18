<?php
dd('asd');
?>
@if (!empty($lead))
    {!! Form::model($lead, ['id'=>'editForm', 'method' => 'PATCH', 'action'=>['LeadsController@update', $lead->id],
    'class' => 'form-horizontal form-non-style lead-edit', 'files' => true ]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Lead {{$lead->id}}</h4><br/>
            <span class="modal-title"> Details</span>
        </div>

        <div class="modal-body">
            <div class="row">
                @include ('leads.formCreate', ['companies' => $companies])
            </div>
        </div>
        @include('errors.list')
        <div class="modal-footer">
            <button
                    {{--onclick="editLeadsValidateErrors()" --}}
                    type="submit" class="btn btn-cyan btn-primary">
                {{--<i class="fa fa-flash"></i>&nbsp;--}}
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