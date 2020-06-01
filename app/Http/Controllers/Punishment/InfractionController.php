<?php

namespace App\Http\Controllers\Punishment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Punishment\Infraction;

class InfractionController extends Controller
{
    public function index(Request $req)
    {
        $data = Infraction::simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    public function search(Request $req)
    {
        $this->validate($req->all(), [
            'q' => 'present',
            'field' => 'present'
        ]);
        $data = Infraction::where($req->field, 'like', "%$req->q%")->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    public function create(Request $req)
    {
        $data = $req->except('files');

        $this->validate($data, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $infraction = new Infraction();
        $infraction->name = $data['name'];
        $infraction->description = $data['description'];
       
        return response()->json($infraction);
    }

    public function find($id)
    {
        if (!$infraction = Infraction::find($id)) {
            abort(404, "No infraction found with id $id");
        }
        return response()->json($infraction);
    }

    public function update(Request $req, $id)
    {
        $infraction = Infraction::find($id);
        if (!$infraction) {
            abort(404, "No infraction found with id $id");
        }

        $data = $req->except('files');

        $this->validate($data, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if (null !== $data['name']) $infraction->name = $data['name'];
        if (null !== $data['description']) $infraction->description = $data['description'];

        $infraction->update();

        return response()->json($infraction);
    }

    public function destroy($id)
    {
        if (!$infraction = Infraction::find($id)) {
            abort(404, "No infraction found with id $id");
        }

        $infraction->delete();
        return response()->json();
    }
}
