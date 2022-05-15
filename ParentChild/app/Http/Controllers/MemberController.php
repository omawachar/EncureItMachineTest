<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index()
    {
        $members = Member::parent()->get();
        $allMembers = Member::all();
        return view('memberTreeView', compact('members', 'allMembers'));

    }

    public function addMember(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $input['parent_id'] =  $input['parent_id'] ?? 0;
        Member::create($input);
        return response()->json(['status' => 1, 'message' => 'New Member added successfully.'], 200);
    
    }
}
