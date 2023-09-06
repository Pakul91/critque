<?php

namespace App\Jobs;

use App\Models\Movie; 
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MovieCSVUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;


    public $header;
    public $data;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $movie) {
            $movieData = array_combine($this->header,$movie);

            $movieData['tagline'] = $this->truncate($movieData['tagline'], 100);

            Movie::create($movieData);
        }
    }

    private function truncate($string, $length=100, $append="&hellip;") {
        $string = trim($string);
      
        if(strlen($string) > $length) {
          $string = wordwrap($string, $length);
          $string = explode("\n", $string, 2);
          $string = $string[0] . $append;
        }
      
        return $string;
      }
}
