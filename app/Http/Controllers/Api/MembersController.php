<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\MemberSpouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 100);
        $search  = trim($request->get('search'));

        $query = Member::with([
            'spouse',
            'townDetail',
            'barangayDetail'
        ])->orderBy('Id');
    
        if ($request->filled('gender')) {
            $query->where('Gender', $request->gender);
        }

         if ($request->filled('town')) {
            $town = \App\Models\Town::where('Town', $request->town)->first();
            if ($town) {
                $query->where('Town', $town->id);
            }
        }

        if ($request->filled('barangay')) {
            $query->whereHas('barangayDetail', function ($q) use ($request) {
                $q->where('Barangay', $request->barangay);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {

                $q->where('FirstName', 'like', "%{$search}%")
                ->orWhere('MiddleName', 'like', "%{$search}%")
                ->orWhere('LastName', 'like', "%{$search}%");

                $q->orWhereHas('spouse', function ($sq) use ($search) {
                    $sq->where('FirstName', 'like', "%{$search}%")
                    ->orWhere('MiddleName', 'like', "%{$search}%")
                    ->orWhere('LastName', 'like', "%{$search}%");
                });
            });
        }

        return MemberResource::collection(
            $query->cursorPaginate($perPage)
        );
    }

    public function store(MemberRequest $request)
    {
        $member = Member::create($request->validated());

        return new MemberResource(
            $member->load('spouse')
        );
    }

    public function show($id)
    {
        $member = Member::with('spouse')->find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        return new MemberResource($member);
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->update($request->validated());

        return new MemberResource(
            $member->load('spouse')
        );
    }

    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->delete();

        return response()->json([
            'message' => 'Member deleted successfully'
        ]);
    }
}
