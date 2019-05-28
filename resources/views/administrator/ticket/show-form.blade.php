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
            {{ Form::textarea('ticketNote', @$data['model']->note, ['class'=>'col-xs-10 col-sm-5','placeholder'=>'note', 'disabled' => "disabled"]) }}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="control-group">
        {{ Form::label('Radio', 'Radio:', array('class'=>'control-label col-xs-12 col-sm-3 no-padding-right')) }}
        <div class="radio">
            @foreach (@$data['ticketStatus'] as $status)
            <label>
                {{ Form::radio('ticketStatus', $loop->index, $loop->index == @$data['model']->status ? true : false, ['class' => 'ace', 'disabled' => "disabled"]) }}
                <span class="lbl"> {{ $status }}</span>
            </label>
            @endforeach
        </div>

    </div>
</div>