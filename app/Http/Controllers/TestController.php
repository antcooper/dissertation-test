<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $files = $this->getDirContents(public_path('samples/source/'));

        echo(hash('sha256', 'a.cooper2@lancaster.ac.uk'));

        return view('index', ['files' => $files]);
    }

    public function embed(Request $request)
    {

        dd($request->input('file'));
        // $oWatermark = new Watermark();

    // $result = $oWatermark->embed(
    //     public_path('samples/source/0878_cycling-in-the-peak-district-gpx.zip'),
    //     public_path('samples/output/').date('Y-m-d'),
    //     'richardbutler4@hotmail.com - 9781786310361',
    //     [
    //         'name' => 'Coledale Horseshoe',
    //         'desc' => 'Prepared for richardbutler4@hotmail.com. Route copyright Cicerone Press Limited. Not for public distribuion.',
    //         'src' => 'https://www.cicerone.co.uk/walking-the-lake-district-fells-buttermere-second'
    //     ],
    //     'Cicerone Press https://www.cicerone.co.uk'
    // );

        return view('index', ['files' => $files]);
    }


    /**
     * Recursively get files from a folder structure
     *
     * @param  string $dir
     * @return array
     */    
    private function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
    
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path) && (substr($path, -3) == 'gpx' || substr($path, -3) == 'zip')) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
            }
        }
    
        return $results;
    }    
}