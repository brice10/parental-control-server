<?php

namespace App\Http\Controllers\Punishment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Punishment\Chore;

class ChoreController extends Controller
{
    public function index(Request $req)
    {
        $data = Chore::simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    public function search(Request $req)
    {
        $this->validate($req->all(), [
            'q' => 'present',
            'field' => 'present'
        ]);
        $data = Chore::where($req->field, 'like', "%$req->q%")->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    public function create(Request $req)
    {
        $data = $req->except('files');

        $this->validate($data, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $chore = new Chore();
        $chore->name = $data['name'];
        $chore->description = $data['description'];
       
        return response()->json($chore);
    }

    public function find($id)
    {
        if (!$chore = Chore::find($id)) {
            abort(404, "No chore found with id $id");
        }
        return response()->json($chore);
    }

    public function update(Request $req, $id)
    {
        $chore = Chore::find($id);
        if (!$chore) {
            abort(404, "No chore found with id $id");
        }

        $data = $req->except('files');

        $this->validate($data, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if (null !== $data['name']) $chore->name = $data['name'];
        if (null !== $data['description']) $chore->description = $data['description'];

        $chore->update();

        return response()->json($chore);
    }

    public function destroy($id)
    {
        if (!$chore = Chore::find($id)) {
            abort(404, "No chore found with id $id");
        }

        $chore->delete();
        return response()->json();
    }
}
