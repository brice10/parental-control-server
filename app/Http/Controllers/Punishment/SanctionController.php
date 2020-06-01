<?php

namespace App\Http\Controllers\Punishment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Punishment\Sanction;

class SanctionController extends Controller
{
    public function index(Request $req)
    {
        $data = Sanction::simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    public function search(Request $req)
    {
        $this->validate($req->all(), [
            'q' => 'present',
            'field' => 'present'
        ]);
        $data = Sanction::where($req->field, 'like', "%$req->q%")->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    public function create(Request $req)
    {
        $data = $req->except('files');

        $this->validate($data, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $sanction = new Sanction();
        $sanction->name = $data['name'];
        $sanction->description = $data['description'];
       
        return response()->json($sanction);
    }

    public function find($id)
    {
        if (!$sanction = Sanction::find($id)) {
            abort(404, "No sanction found with id $id");
        }
        return response()->json($sanction);
    }

    public function update(Request $req, $id)
    {
        $sanction = Sanction::find($id);
        if (!$sanction) {
            abort(404, "No sanction found with id $id");
        }

        $data = $req->except('files');

        $this->validate($data, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if (null !== $data['name']) $sanction->name = $data['name'];
        if (null !== $data['description']) $sanction->description = $data['description'];

        $sanction->update();

        return response()->json($sanction);
    }

    public function destroy($id)
    {
        if (!$sanction = Sanction::find($id)) {
            abort(404, "No sanction found with id $id");
        }

        $sanction->delete();
        return response()->json();
    }
}
