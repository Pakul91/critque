@extends('layouts.layout')

@section('content')
    <h1 class="text-4xl">Movies</h1>

    @if(isset($movies) && $movies->count() > 0)
    <div class="border border-dash border-white p-8 my-8 flex flex-col">

        <!-- create table with name tagline and release_date-->
        <table class="my-5">
            <thead class="">
                <tr>
                    <th class="text-left">Title</th>
                    <th class="text-left">Tagline</th>
                    <th class="text-left">Release Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                <tr>
                    <td class="border border-dash border-white p-2"><a href="/admin/movies/{{$movie->id}}">{{$movie->title}}</a></td>
                    <td class="border border-dash border-white p-2">{{$movie->tagline}}</td>
                    <td class="border border-dash border-white p-2">{{$movie->release_date}}</td>
                </tr>
                @endforeach
        </table>
   
        <div id="paginator" class="fixed w-full bottom-0 pb-6 px-3 pt-2 left-0 bg-slate-900 justify-center">
            {{$movies->links()}}
        </div>
    </div>
    @else
    <div id="message" class="border border-dash border-white p-8 mt-8 flex justify-between">
        There are currently no movies saved. 
    </div>
    @endif

    <script>
        // Little hack to style built in paginator
       const paginator = document.querySelector('#paginator ');
       paginator?.firstElementChild?.children[1].classList.add('flex-col', 'gap-2');
    </script>


   
@endsection