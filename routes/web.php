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
    $files = \App\Models\File::orderBy('no', 'desc')->get();

    return view('home', compact('files'));
});

$router->get('/file/{slug}', ['as' => 'files.show', function ($slug) {
    try {
        [$no, $date] = getFileIdAndDateFromSlug($slug);
    } catch (\Carbon\Exceptions\InvalidFormatException $e) {
        abort(\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
    }

    $file = \App\Models\File::whereNo($no)->first();

    if (!$file || $file->published_at->toDateString() !== $date->toDateString()) {
        abort(\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
    }

    $fileContents = Storage::disk('local')->get('files/' . $file->id . '.' . $file->extension);

    return response($fileContents, \Symfony\Component\HttpFoundation\Response::HTTP_OK)
        ->header('Content-Type', $file->mimetype)
        ->header('Content-disposition', "inline; filename=\"{$file->no} vom {$file->published_at->format('d.m.Y')}.pdf\"");
}]);
