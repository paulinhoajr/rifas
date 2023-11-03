<div class="form-group{{ $errors->has('campanha_id') ? 'has-error' : ''}}">
    <label for="campanha_id" class="control-label">{{ 'Campanha Id' }}</label>
    <input class="form-control" name="campanha_id" type="number" id="campanha_id" value="@if($formMode == 'edit'){{ $imagen->campanha_id }}@else{{old('campanha_id')}}@endif" required>

    {!! $errors->first('campanha_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="@if($formMode == 'edit'){{ $imagen->nome }}@else{{old('nome')}}@endif" >

    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('caminho') ? 'has-error' : ''}}">
    <label for="caminho" class="control-label">{{ 'Caminho' }}</label>
    <input class="form-control" name="caminho" type="text" id="caminho" value="@if($formMode == 'edit'){{ $imagen->caminho }}@else{{old('caminho')}}@endif" >

    {!! $errors->first('caminho', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('ordem') ? 'has-error' : ''}}">
    <label for="ordem" class="control-label">{{ 'Ordem' }}</label>
    <input class="form-control" name="ordem" type="number" id="ordem" value="@if($formMode == 'edit'){{ $imagen->ordem }}@else{{old('ordem')}}@endif" >

    {!! $errors->first('ordem', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="@if($formMode == 'edit'){{ $imagen->status }}@else{{old('status')}}@endif" >

    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
