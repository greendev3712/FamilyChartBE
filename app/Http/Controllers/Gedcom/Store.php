<?php

namespace App\Http\Controllers\Gedcom;

use App\Event;
use App\Family;
use App\Http\Controllers\Controller;
use App\Jobs\ImportGedcom;
use App\Note;
use App\Person;
use App\Source;
use App\Traits\ConnectionTrait;
use Auth;
use GenealogiaWebsite\LaravelGedcom\Facades\GedcomParserFacade;
use GenealogiaWebsite\LaravelGedcom\Utils\GedcomParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use LaravelEnso\Multitenancy\Enums\Connections;

class Store extends Controller
{
    use ConnectionTrait;
    /*
    * Api end-point for Gedcom api/gedcom/store
    * Saving uploaded file to storage and starting to read
    */

    public function __invoke(Request $request)
    {
        $slug = $request->get('slug');
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                try {
                    $conn = $this->getConnection();
                    $db = $this->getDB();
                    $currentUser = Auth::user();
                    $_name = uniqid().'.ged';
                    $request->file->storeAs('gedcom', $_name);
                    define('STDIN', fopen('php://stdin', 'r'));
                    // $parser = new GedcomParser();
                    // $parser->parse($request->file('file'), $slug, true);
                    $filename = 'app/gedcom/'.$_name;
                    ImportGedcom::dispatch($filename, $slug, $currentUser->id, $conn, $db);

                    return ['File uploaded: conn:-'.$conn.'-'];
                } catch (\Exception $e) {
                    return ['Not uploaded'];
                }
            }

            return ['File corrupted'];
        }

        return ['Not uploaded'];
    }
}
