<div class="form-group">
    {{ Form::label('name', 'Name:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::text('ticketName', @$data['model']->name, ['class'=>'col-xs-10 col-sm-5','placeholder'=>'Name', 'disabled' => "disabled"]) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('unit_id', 'Unit:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::text('unitName', @$data['unitName'], ['class'=>'col-xs-10 col-sm-5','placeholder'=>'Unit', 'disabled' => "disabled"]) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('type', 'Type:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::text('nonRentPayment', @$data['nonRentPayment'], ['class'=>'col-xs-10 col-sm-5','placeholder'=>'Type', 'disabled' => "disabled"]) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('amount', 'Amount:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::text('ticketAmount', @$data['model']->amount, ['class'=>'col-xs-10 col-sm-5 price-validator','placeholder'=>'Amount', 'disabled' => "disabled"]) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('description', 'Description:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::textarea('ticketDescription', @$data['model']->description, ['class'=>'col-xs-10 col-sm-5','placeholder'=>'Description', 'disabled' => "disabled"]) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('note', 'Note:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            {{ Form::textarea('note', @$data['model']->note, ['class'=>'col-xs-10 col-sm-5','placeholder'=>'note']) }}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="control-group">
        {{ Form::label('Radio', 'Radio:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
        <div class="radio">
            @foreach (@$data['ticketStatus'] as $status)
            <label>
                {{ Form::radio('status', $loop->index, $loop->index == @$data['model']->status ? true : false, ['class' => 'ace']) }}
                <span class="lbl"> {{ $status }}</span>
            </label>
            @endforeach
        </div>

    </div>
</div>

<div class="form-group">
    {{ Form::label('assigned_user_id', 'Assigned to Assistants:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
    <div class="col-xs-12 col-sm-9">
        <div class="clearfix">
            <select class="form-col-xs-10 col-sm-5" name="assigned_user_id">
                <option value="0"> - Select Product - </option>
                @foreach ($data['assistants'] as $key => $assistant)
                    <option value="{{ $assistant->id }}" {{ $data['ticketAssistantId'] == $assistant->id ? 'selected' : '' }}>
                        {{ $assistant->email }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@if (!is_null(@$data['model']->id))
    {{ Form::hidden('id', @$data['model']->id) }}
@endif
<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-check bigger-110"></i> Save</button>
        <a class="btn" href="{{ url('/'.$data['modules']) }}"><i class="ace-icon fa fa-times bigger-110"></i> Cancel
        </a>
    </div>
</div>