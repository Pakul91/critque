<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MovieCSVUploadJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class MoviesController extends Controller
{
    public function index()
    {
        return view('admin.movies.index');
    }

    public function import(Request $request)
    {
            
    }

}
