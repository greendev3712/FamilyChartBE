<?php

namespace App\Http\Controllers\Gedcom;

use App\Note;
use App\Event;
use App\Family;
use App\Person;
use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Asdfx\LaravelGedcom\Facades\GedcomParserFacade;
use Asdfx\LaravelGedcom\Utils\GedcomParser;
class Store extends Controller
{
    /*
    * Api end-point for Gedcom api/gedcom/store
    * Saving uploaded file to storage and starting to read
    */

    public function __invoke(Request $request)
    {
        
            if ($request->hasFile('file')) {
                if ($request->file('file')->isValid()) {
                    try{
                        $request->file->storeAs('gedcom', 'file.ged');
                        $parser = new GedcomParser();
                        $parser->parse($request->file('file'), true);
        
                        return ['File uploaded'];
                    }catch(Exception $e){
                        return ['Not uploaded'];
                    }
                }
    
                return ['File corrupted'];
            }
        
        return ['Not uploaded'];
    }
}
