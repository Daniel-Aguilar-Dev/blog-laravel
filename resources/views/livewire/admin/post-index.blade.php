<div class="card">


    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre del post">
    </div>
    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td width="15px">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                            </td>
                            <td width="15px">
                                {!! Form::open([
                                    'route' => ['admin.posts.destroy', $post],
                                    'method' => 'delete',
                                    'onsubmit' => 'return confirm("Esta seguro de borrar el post?")',
                                ]) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún registro.</strong>
        </div>
    @endif
</div>
