<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use App\Persons;
use Illuminate\Support\Facades\Auth;
class PersonsController extends Controller
{
    static protected $_url = "https://swapi.co/api/people";

    public function __construct() {
        $this->middleware('auth');
//        $this->middleware('auth', ['except' => 'create']);
    }

    public function  index () {

        $persons = Persons::all();

        return view('persons', compact('persons'));
    }

    public function getAllPersons() {
        $obj = $this->getContent(self::$_url);

        $this->getData($obj);

        $this->index();
    }

    public function getContent($url) {
        $obj = null;

        if (isset($url) && $url != null) {
            $json = file_get_contents($url);
            $obj = json_decode($json);
        }

        return $obj;
    }

    public function getData($obj) {
            $personsData = $obj->results;
            if (isset($personsData)) {
                foreach ($personsData as $value) {
                    foreach ($value as $key => $item) {
                        if (is_array($item)) {
                            $value->$key = json_encode($value->$key, JSON_UNESCAPED_SLASHES);
    //                        $value->$key = $links = implode(',', $value->$key);
                        }
                    }
                    $data = (array) $value;
                    $this->create($data);
                }
            }

        if (isset($obj->next) && $obj->next != null) {
            $obj = $this->getContent($obj->next);
            self::getData($obj);
        } else {
            $this->create($data);
        }
    }

    public function create ($data) {
        Auth::user()->persons()->firstOrCreate($data);
    }

    public function store(Request $request)
    {
        $persons = new Persons();

        $persons->name = $request->name;
dd($persons);
        $persons->save();
    }

    public function edit($id)
    {
        $persons = Article::findOrFail($id);
//
//        $tags = Tag::pluck('name', 'id');
//        return view ('articles.edit', compact('article', 'tags'));
////
//        $persons = Persons::all();
//        $companies = Company::orderBy('name', 'asc')->get();
        return view('leads.modalEditLeads', compact('lead', 'users', 'companies'));
    }

    public function destroy($id)
    {
        Lead::destroy($id['id']);
        flash('successfully DELETED!', 'danger');
        return redirect('leads');
    }

}
