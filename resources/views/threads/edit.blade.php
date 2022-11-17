@extends('layouts.app')


@section('content')
    <div class="col">
        <div class="col-12">

            <h2>Editar tópico</h2>
            <hr>
        </div>

        <div class="col-12">
            <form class="form" action="{{ route('threads.update', $thread->slug) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group pb-2">
                    <label for="">Escolha o canal do tópico</label>
                    <select name="channel_id" id="" class="form-select" required>
                        <option value="">-- Channels</option>
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group pb-2">
                    <label for="">Título</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ $thread->title }}"
                        required>
                </div>

                <div class="form-group pb-2">
                    <label for="">Conteúdo</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control" required>{{ $thread->body }}</textarea>
                </div>

                <button class="btn btn-lg btn-success" type="submit">Atualizar</button>
            </form>
        </div>
    </div>
@endsection
