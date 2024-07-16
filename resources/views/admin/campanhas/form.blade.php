<div class="form-group{{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="@if($formMode == 'edit'){{ $campanha->nome }}@else{{old('nome')}}@endif" required>

    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('bilhete_id') ? 'has-error' : ''}}">
    <label for="bilhete_id" class="control-label">{{ 'Bilhete Id' }}</label>
    <input class="form-control" name="bilhete_id" type="number" id="bilhete_id" value="@if($formMode == 'edit'){{ $campanha->bilhete_id }}@else{{old('bilhete_id')}}@endif" required>

    {!! $errors->first('bilhete_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('categoria_id') ? 'has-error' : ''}}">
    <label for="categoria_id" class="control-label">{{ 'Categoria Id' }}</label>
    <input class="form-control" name="categoria_id" type="number" id="categoria_id" value="@if($formMode == 'edit'){{ $campanha->categoria_id }}@else{{old('categoria_id')}}@endif" required>

    {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('preco') ? 'has-error' : ''}}">
    <label for="preco" class="control-label">{{ 'Preco' }}</label>
    <input class="form-control" name="preco" type="number" id="preco" value="@if($formMode == 'edit'){{ $campanha->preco }}@else{{old('preco')}}@endif" required>

    {!! $errors->first('preco', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('sorteio_id') ? 'has-error' : ''}}">
    <label for="sorteio_id" class="control-label">{{ 'Sorteio Id' }}</label>
    <input class="form-control" name="sorteio_id" type="number" id="sorteio_id" value="@if($formMode == 'edit'){{ $campanha->sorteio_id }}@else{{old('sorteio_id')}}@endif" required>

    {!! $errors->first('sorteio_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('whatsapp') ? 'has-error' : ''}}">
    <label for="whatsapp" class="control-label">{{ 'Whatsapp' }}</label>
    <input class="form-control" name="whatsapp" type="text" id="whatsapp" value="@if($formMode == 'edit'){{ $campanha->whatsapp }}@else{{old('whatsapp')}}@endif" >

    {!! $errors->first('whatsapp', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('modelo') ? 'has-error' : ''}}">
    <label for="modelo" class="control-label">{{ 'Modelo' }}</label>
    <input class="form-control" name="modelo" type="number" id="modelo" value="@if($formMode == 'edit'){{ $campanha->modelo }}@else{{old('modelo')}}@endif" required>

    {!! $errors->first('modelo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="control-label">{{ 'Descricao' }}</label>
    <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >@if($formMode == 'edit'){!! $campanha->descricao !!}@else {!! old('descricao') !!} @endif</textarea>

    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('minima') ? 'has-error' : ''}}">
    <label for="minima" class="control-label">{{ 'Minima' }}</label>
    <input class="form-control" name="minima" type="number" id="minima" value="@if($formMode == 'edit'){{ $campanha->minima }}@else{{old('minima')}}@endif" >

    {!! $errors->first('minima', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('maxima') ? 'has-error' : ''}}">
    <label for="maxima" class="control-label">{{ 'Maxima' }}</label>
    <input class="form-control" name="maxima" type="number" id="maxima" value="@if($formMode == 'edit'){{ $campanha->maxima }}@else{{old('maxima')}}@endif" >

    {!! $errors->first('maxima', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('filtro') ? 'has-error' : ''}}">
    <label for="filtro" class="control-label">{{ 'Filtro' }}</label>
    <input class="form-control" name="filtro" type="number" id="filtro" value="@if($formMode == 'edit'){{ $campanha->filtro }}@else{{old('filtro')}}@endif" >

    {!! $errors->first('filtro', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="@if($formMode == 'edit'){{ $campanha->date }}@else{{old('date')}}@endif" >

    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('tempo') ? 'has-error' : ''}}">
    <label for="tempo" class="control-label">{{ 'Tempo' }}</label>
    <input class="form-control" name="tempo" type="text" id="tempo" value="@if($formMode == 'edit'){{ $campanha->tempo }}@else{{old('tempo')}}@endif" >

    {!! $errors->first('tempo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="@if($formMode == 'edit'){{ $campanha->email }}@else{{old('email')}}@endif" >

    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="@if($formMode == 'edit'){{ $campanha->status }}@else{{old('status')}}@endif" required>

    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="inicial" class="control-label">Página inicial</label>
    <select class="form-select" id="inicial" name="inicial">
        <option value="1">Ativo</option>
        <option value="0">Inativo</option>
    </select>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
