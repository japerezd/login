@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage {{ $user->name }}</div>

                <div class="card-body">
                    {{-- pasar los usuarios actuales y listar los roles de muestra base de datos --}} 
                    {{-- pasando el usuario que intenta editar --}}
                    <form action="{{ route('admin.users.update', ['user'=>$user->id]) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        @foreach ($roles as $role)
                            <div class="form-check">
                                {{-- con user-> checamos que si el usuer tiene ese rol, que ya este check --}}
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                {{ $user->hasAnyRole($role->name) ? 'checked':''}}>
                            <label>{{ $role->name }}</label>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
