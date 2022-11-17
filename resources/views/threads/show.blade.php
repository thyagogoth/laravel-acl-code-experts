@extends('layouts.app')


@section('content')
    <div class="col">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <small>Criado por: {{ $thread->user->name }} a
                        {{ $thread->created_at->diffForHumans() }}
                    </small>
                </div>
                <div class="card-body">
                    <h5>{{ $thread->title }}</h5>
                    {{ $thread->body }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('threads.edit', $thread->slug) }}" class="btn btn-sm btn-primary">Editar</a>

                    <a href="{{ route('threads.destroy', $thread->slug) }}" class="btn btn-sm btn-danger"
                        onclick="event.preventDefault(); document.getElementById('delete-thread').submit()">
                        Excluir
                    </a>
                    <form id="delete-thread" action="{{ route('threads.destroy', $thread->slug) }}" method="post"
                        style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>

        @if ($thread->replies->count() > 0)
            <hr>
            <div class="col-12">
                <h5>Respostas</h5>
                <hr>
                @foreach ($thread->replies as $reply)
                    <div class="card mb-1">
                        <div class="card-body">
                            {{ $reply->reply }}
                        </div>
                        <div class="card-footer">
                            <small>Respondido por {{ $reply->user->name }} a
                                {{ $reply->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @auth
            <div class="col-12">
                <hr>
                <form action="{{ route('replies.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="thread_id" value="{{ $thread->id }}" />
                    <div class="form-group pb-1">
                        <h3>Responder</h3>
                        <textarea name="reply" id="" cols="30" rows="6"
                            class="form-control @if ('reply') is-invalid @endif"></textarea>

                        @error('channel_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-success" type="submit">Responder</button>
                </form>
            </div>
        @else
            <div class="col-12 py-4 text-center">
                {{-- <div class="alert alert-warning"> --}}
                <h6>Você precisa estar logado! <a href="/login">Clique aqui</a></h6>
                {{-- </div> --}}
            </div>
        @endauth

    </div>
@endsection
