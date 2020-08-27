@extends('layouts.app')

@section('content')
    <h1>Interkommunales Amtsblatt: „WIR im Frankenwald”</h1>

    @if ($files->isEmpty())
        <div class="siimple-alert siimple-alert--primary">
            Noch keine Dateien vorhanden.
        </div>
    @endif

    <div class="ui fluid vertical menu">
        @foreach ($files as $file)
            <a class="item" href="{{ route('files.show', ['id' => $file]) }}">
                #{{ $file->no }}
                vom
                {{ $file->published_at->format('d.m.Y') }}
            </a>
        @endforeach
    </div>
@endsection
