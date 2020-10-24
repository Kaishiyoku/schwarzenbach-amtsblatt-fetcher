@extends('layouts.app')

@section('content')
    <h1 class="text-4xl mb-5">Interkommunales Amtsblatt: „WIR im Frankenwald”</h1>

    <div class="rounded overflow-hidden shadow-lg bg-white border border-gray-200">
        @if ($files->isEmpty())
            <div class="text-lg italic text-gray-600 p-4">
                Noch keine Dateien vorhanden.
            </div>
        @else
            <div class="flex flex-col">
                @foreach ($files as $file)
                    <a href="{{ route('files.show', ['slug' => toFileSlug($file)]) }}" class="px-4 py-2 border-b border-indigo-200 border-opacity-25 hover:bg-indigo-200 hover:bg-opacity-25 transition-colors ease-out duration-500">
                        #{{ $file->no }}
                        vom
                        {{ $file->published_at->format('d.m.Y') }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
