<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="@if($formMode == 'edit'){{ $empresa->name }}@else{{old('name')}}@endif" >

    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('teste') ? 'has-error' : ''}}">
    <label for="teste" class="control-label">{{ 'Teste' }}</label>
    <input class="form-control" name="teste" type="text" id="teste" value="@if($formMode == 'edit'){{ $empresa->teste }}@else{{old('teste')}}@endif" >

    {!! $errors->first('teste', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
