<div class="form-group">
    {{ Form::label('name', 'Name:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::text('name',@$data['model']->name,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Name']) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('unit_id', 'Unit:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::select('unit_id', $data['units'], @$data['model']->unit_id, ['class'=>'col-xs-10 col-sm-5 countries-select']) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('type', 'Type:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::select('type', $data['nonRentPayments'], @$data['model']->type, ['class'=>'col-xs-10 col-sm-5 countries-select']) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('amount', 'Amount:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::text('amount',@$data['model']->amount,['class'=>'col-xs-10 col-sm-5 price-validator','placeholder'=>'Amount']) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('description', 'Description:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::textarea('description',@$data['model']->description,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Description']) }}
        </div>
    </div>
</div>

@if (!is_null(@$data['model']->id))
    {{ Form::hidden('id', @$data['model']->id) }}
@endif
<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-check bigger-110"></i> Save</button>
        <a class="btn" href="{{ url('/'.$data['modules']) }}"><i class="ace-icon fa fa-times bigger-110"></i> Cancel </a>
    </div>
</div>