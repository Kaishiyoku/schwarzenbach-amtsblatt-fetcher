<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    $fileChunks = \App\Models\File::orderBy('published_at', 'desc')->get()->groupBy(function (\App\Models\File $file) {
        return $file->published_at->format('Y');
    });

    return view('home', compact('fileChunks'));
});

$router->get('/file/{slug}', ['as' => 'files.show', function ($slug) {
    try {
        [$no, $date] = getFileIdAndDateFromSlug($slug);
    } catch (\Carbon\Exceptions\InvalidFormatException $e) {
        abort(\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
    }

    $file = \App\Models\File::whereNo($no)->whereDate('published_at', $date)->firstOrFail();

    $fileContents = Storage::disk('local')->get('files/' . $file->id . '.' . $file->extension);

    return response($fileContents, \Symfony\Component\HttpFoundation\Response::HTTP_OK)
        ->header('Content-Type', $file->mimetype)
        ->header('Content-disposition', "inline; filename=\"{$file->no} vom {$file->published_at->format('d.m.Y')}.pdf\"");
}]);
