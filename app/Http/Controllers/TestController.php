<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use antcooper\gpxwatermark\Embed;
use antcooper\gpxwatermark\Extract;


class TestController extends Controller
{
    public function index()
    {
        $source = $this->getDirContents(public_path('samples/source/'));
        $output = $this->getDirContents(public_path('samples/output/'));

        $watermarked = [];
        foreach ($output as $file) {
            $watermarked[] = preg_replace('/(.*public)/i','', $file);
        }

        return view('index', ['source' => $source, 'output' => $watermarked]);
    }

    public function embed(Request $request)
    {

        $oWatermark = new Embed(
            public_path('samples/source/'.$request->input('file')),
            public_path('samples/output/').$request->input('method').'/'.date('Y-m-d'),
            'ABCD',
            [
                'name' => 'Coledale Horseshoe',
                'desc' => 'Prepared on '.date('Y-m-d \a\t H:i').' for email@hotmail.com. Route copyright Cicerone Press Limited. Not for public distribution.',
                'src' => 'https://www.cicerone.co.uk/walking-the-lake-district-fells-buttermere-second'
            ],
            'Cicerone Press https://www.cicerone.co.uk'
        );

        $result = $oWatermark->write($request->input('method'));

        return redirect('/')->with('status', 'Payload inserted in '.$request->input('file'));
    }

    public function blindExtract(Request $request)
    {
        $oExtract = new Extract();
        $result = $oExtract->blind(public_path($request->input('file')));
        dd($result);
    }

    public function nonBlindExtract(Request $request)
    {
        $oExtract = new Extract();

        $source = public_path($request->input('file'));
        $original = public_path('samples/source/'.basename($source));

        $result = $oExtract->nonBlind($original, $source);
        dd($result);
    }

    /**
     * Recursively get GPX files from a folder structure
     *
     * @param  string $dir
     * @return array
     */    
    private function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
    
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                self::getDirContents($path, $results);
            }
        }
    
        return $results;
    }
}