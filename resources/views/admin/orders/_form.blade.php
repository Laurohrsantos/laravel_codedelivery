<div class="form-group">
    {!! Form::label('client_id', 'Cliente: ') !!}
    {!! Form::select('client_id', $users, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('user_deliveryman_id', 'Entregador: ') !!}
    {!! Form::select('user_deliveryman_id', $users, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('total', 'Total: ') !!}
    {!! Form::text('total', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('status', 'Status: ') !!}
    {!! Form::text('status', null, ['class'=>'form-control']) !!}
</div>