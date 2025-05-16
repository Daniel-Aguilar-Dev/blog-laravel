<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug del post']) !!}
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('category_id', 'Categoría') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        <label class="mr-2">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>
    @endforeach
    <br>
    @error('tags')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="row mb-4">
    <div class="col">
        <div class="image-wrapper">
            {{-- Verifica si está definido o no --}}
            @isset ($post->image)
            <img id="picture" src="{{ Storage::url($post->image->url) }}">    
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2018/04/22/13/04/hallway-3341001_1280.jpg">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrará en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta sequi culpa, aliquid libero animi
            reiciendis laborum molestias quia atque ducimus perspiciatis sunt omnis laboriosam? Officiis
            voluptates perferendis cupiditate quidem officia.</p>
        @error('file')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<div class="form-group">
    {!! Form::label('extract', 'Extracto:') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
    @error('extract')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('body', 'Cuerpo del post:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <p class="font-weight-bold">Estado</p>

    <!-- Opción 1 (Borrador) -->
    <label class="mr-3">
        {!! Form::radio('status', 1, true) !!} <!-- 'true' para marcarlo por defecto -->
        Borrador
    </label>

    <!-- Opción 2 (Publicado) -->
    <label class="mr-3">
        {!! Form::radio('status', 2, false) !!}
        Publicado
    </label>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
