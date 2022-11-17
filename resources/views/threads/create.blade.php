@extends('layouts.app')


@section('content')
    <div class="col">
        <div class="col-12">
            <h2>Criar tópico</h2>
            <hr>
        </div>

        <div class="col-12">
            <form class="form" action="{{ route('threads.store') }}" method="post">
                @csrf

                <div class="form-group pb-2">
                    <label for="">Escolha o canal do tópico</label>
                    <select name="channel_id" id="" class="form-select @error('channel_id') is-invalid @enderror">
                        <option value="">-- Channels</option>

                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}" @if (old('channel_id') == $channel->id) selected @endif>
                                {{ $channel->name }}</option>
                        @endforeach

                    </select>
                    @error('channel_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group pb-2">
                    <label for="">Título </label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                        id="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group pb-2">
                    <label for="">Conteúdo</label>
                    <textarea name="body" id="" cols="30" rows="10"
                        class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-lg btn-success" type="submit">Criar</button>
            </form>
        </div>
    </div>
@endsection
