@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Editar Usuário</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" class="form-control form-control @error('name') is-invalid @enderror" name="name"
                        placeholder="Ex.: Listar Tópicos" value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control form-control @error('password') is-invalid @enderror"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control form-control" name="password_confirmation">
                </div>

                <div class="mb-3">
                    <label class="form-label">Papéis</label>
                    <select name="role" class="form-select">
                        <option value="">Selecionar o Papel do Usuário</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if ($user->role()->count() && $user->role->id == $role->id) selected @endif>
                                {{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>


                <div class="mb-3">
                    <button class="btn btn-success">Atualizar Usuário</button>
                </div>
            </form>
        </div>
    </div>
@endsection
