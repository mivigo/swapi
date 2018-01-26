<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Persons;
use Illuminate\Support\Facades\Auth;
class PersonsController extends Controller
{
    static protected $_url = "https://swapi.co/api/people";

    public function __construct() {
        $this->middleware('auth');
    }

    public function  index () {

        $persons = Persons::paginate(15);

        return view('persons', compact('persons'));
    }

    public function getAllPersons() {
        $obj = $this->getContent(self::$_url);

        $this->getData($obj);

        return redirect('/');
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

    public function edit($id)
    {
        $users = Persons::all();
        $person = Persons::find($id);
        
        return view('modalEditPerson', compact('person', 'users'));
    }

    public function update(Request $request, Persons $person)
    {
        if ($request->ajax()) {
            $response = ['has been successfully Updated!'];
            return Response::json($response);
        } else {
            $person->update($request->all());
            flash('Lead has been successfully UPDATED!');
            return redirect('persons');
        }
    }

    public function destroy($id)
    {
        Persons::find($id)->delete();
        flash('successfully DELETED!', 'danger');
        return redirect('persons');
    }

}
