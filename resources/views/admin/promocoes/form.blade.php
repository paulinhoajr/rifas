<div class="form-group{{ $errors->has('campanha_id') ? 'has-error' : ''}}">
    <label for="campanha_id" class="control-label">{{ 'Campanha Id' }}</label>
    <input class="form-control" name="campanha_id" type="number" id="campanha_id" value="@if($formMode == 'edit'){{ $promoco->campanha_id }}@else{{old('campanha_id')}}@endif" required>

    {!! $errors->first('campanha_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('quantidade') ? 'has-error' : ''}}">
    <label for="quantidade" class="control-label">{{ 'Quantidade' }}</label>
    <input class="form-control" name="quantidade" type="number" id="quantidade" value="@if($formMode == 'edit'){{ $promoco->quantidade }}@else{{old('quantidade')}}@endif" >

    {!! $errors->first('quantidade', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('valor') ? 'has-error' : ''}}">
    <label for="valor" class="control-label">{{ 'Valor' }}</label>
    <input class="form-control" name="valor" type="number" id="valor" value="@if($formMode == 'edit'){{ $promoco->valor }}@else{{old('valor')}}@endif" >

    {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="@if($formMode == 'edit'){{ $promoco->status }}@else{{old('status')}}@endif" >

    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
