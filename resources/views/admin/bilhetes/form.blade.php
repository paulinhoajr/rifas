<div class="form-group{{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="@if($formMode == 'edit'){{ $bilhete->nome }}@else{{old('nome')}}@endif" required>

    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('quantidade') ? 'has-error' : ''}}">
    <label for="quantidade" class="control-label">{{ 'Quantidade' }}</label>
    <input class="form-control" name="quantidade" type="number" id="quantidade" value="@if($formMode == 'edit'){{ $bilhete->quantidade }}@else{{old('quantidade')}}@endif" required>

    {!! $errors->first('quantidade', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="@if($formMode == 'edit'){{ $bilhete->status }}@else{{old('status')}}@endif" >

    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
