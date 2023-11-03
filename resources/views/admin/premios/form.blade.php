<div class="form-group{{ $errors->has('campanha_id') ? 'has-error' : ''}}">
    <label for="campanha_id" class="control-label">{{ 'Campanha Id' }}</label>
    <input class="form-control" name="campanha_id" type="number" id="campanha_id" value="@if($formMode == 'edit'){{ $premio->campanha_id }}@else{{old('campanha_id')}}@endif" required>

    {!! $errors->first('campanha_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="@if($formMode == 'edit'){{ $premio->nome }}@else{{old('nome')}}@endif" >

    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
