@component('mail::message')
# Ausgabe #{{ $file->no }} vom {{ $file->published_at->format('d.m.Y') }}

@component('mail::button', ['url' => route('files.show', ['slug' => toFileSlug($file)])])
Im Browser anzeigen
@endcomponent

{{ config('app.name') }}
@endcomponent
