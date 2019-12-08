@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->email }}</th>
                                    {{-- obteniendo el rol con la propiedad name en modelo user 
                                        returns a laravel collection and then we are converting toArray
                                        implode() une items en una coleccion de arrays u objetos--}}
                                    <th>{{ implode(", ", $user->roles()->get()->pluck('name')->toArray()) }}</th>
                                    <th>
                                        <a href="{{ route('admin.users.edit',$user->id) }}" class="float-left">
                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                        </a>
                                        <a href="{{ route('admin.impersonate',$user->id) }}" class="float-left">
                                            <button type="button" class="btn btn-success btn-sm">Impersonate user</button>
                                        </a>
                                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST" class="float-left">
                                            @csrf 
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{-- con esto nos muestra los links del numero de pagina de los items --}}
                      {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
