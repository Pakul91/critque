<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Jobs\MovieCSVUploadJob;
use Illuminate\Support\Facades\Bus;

use App\Models\Movie;

class MoviesController extends Controller
{
    public function index()
    {
        return view('admin.movies.index', ['movies' => Movie::paginate(25)]);
    }

    public function movies(){
        return view('admin.movies.movies');
    }

    public function import(Request $request)
    {
        $movies = Movie::all();

        if(count($movies) == 0) {
            Log::info('Importing movies from CSV file', $request->all());

            $file_path = public_path('uploads/movies-trimmed.csv');
            $csv = file($file_path);

            if(!$csv) {
                Log::error('Could not open file');
                return view('admin.movies.index');
            }

            $chunks = array_chunk($csv, 1000);  
            $header = [];
            $batch  = Bus::batch([])->dispatch();


            foreach ($chunks as $key => $chunk) {

                $data = array_map('str_getcsv', $chunk);
                    if($key == 0){
                        $header = $data[0];
                        unset($data[0]);
                    }
                    $batch->add(new MovieCSVUploadJob($data, $header));
                }
        }  

        return view('admin.movies.index', ['movies' => Movie::paginate(25)]);
    }
}
