@extends('layouts.app')

@section('content')
    <h1>Interkommunales Amtsblatt: "WIR im Frankenwald"</h1>

    @if ($files->isEmpty())
        <div class="siimple-alert siimple-alert--primary">
            Noch keine Dateien vorhanden.
        </div>
    @endif

    <div class="siimple-list siimple-list--hover">
        @foreach ($files as $file)
            <a class="siimple-list-item" href="{{ route('files.show', ['id' => $file]) }}">
                #{{ $file->no }}
                vom
                {{ $file->published_at->format('d.m.Y') }}
            </a>
        @endforeach
    </div>
@endsection
