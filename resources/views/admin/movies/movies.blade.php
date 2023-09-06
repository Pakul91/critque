@extends('layouts.layout')

@section('content')
    <h1 class="text-4xl">Movies</h1>

    <div id="message" class="border border-dash border-white p-8 mt-8 flex justify-between">
        <div class="flex flex-col gap-2">
            <p>Click the button to import the movies.</p>
            <p>This may take a moment.</p>
            <p>You will be redirected once process is done</p>
        </div>

        <form id="form" action="/admin/" method="POST">
            @csrf
            <input type="submit" value="Import Movies" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
@endsection