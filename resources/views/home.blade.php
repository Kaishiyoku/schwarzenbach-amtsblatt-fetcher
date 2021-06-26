@extends('layouts.app')

@section('content')
    <h1 class="text-4xl mb-5">Interkommunales Amtsblatt: „WIR im Frankenwald”</h1>

    @if ($fileChunks->isEmpty())
        <div class="text-lg italic text-gray-600 p-4">
            Noch keine Dateien vorhanden.
        </div>
    @else
        <div class="lg:grid lg:grid-cols-2 xl:grid-cols-3 lg:gap-x-4">
            @foreach ($fileChunks as $year => $fileChunk)
                <div class="mb-8">
                    <div class="text-2xl font-semibold pb-2">
                        {{ $year }}
                    </div>

                    <div class="rounded overflow-hidden bg-white border border-gray-200 shadow-lg">
                        @foreach ($fileChunk as $file)
                            <a href="{{ route('files.show', ['slug' => toFileSlug($file)]) }}" class="block px-4 py-2 border-b border-gray-100 hover:text-white hover:bg-indigo-500 transition-colors ease-in">
                                #{{ $file->no }}
                                vom
                                {{ $file->published_at->format('d.m.Y') }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
