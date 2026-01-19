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
        $search = $request->get('search', null);

        $query = Member::with('spouse')->orderBy('Id');

        if ($request->filled('town')) {
            $query->where('Town', $request->town);
        }

        if ($request->filled('gender')) {
            $query->where('Gender', $request->gender);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
   
                $q->where('Id', 'like', "{$search}%")
                ->orWhere('FirstName', 'like', "{$search}%")
                ->orWhere('LastName', 'like', "{$search}%")
                ->orWhere('EmailAddress', 'like', "{$search}%");

                $q->orWhereHas('spouse', function ($sq) use ($search) {
                    $sq->where('Id', 'like', "{$search}%")
                    ->orWhere('FirstName', 'like', "{$search}%")
                    ->orWhere('LastName', 'like', "{$search}%")
                    ->orWhere('EmailAddress', 'like', "{$search}%");
                });

                $q->orWhereIn('Id', function($sub) use ($search) {
                    $sub->select('MemberConsumerId')
                        ->from('CRM_MemberConsumerSpouse')
                        ->where('Id', 'like', "{$search}%")
                        ->orWhere('FirstName', 'like', "{$search}%")
                        ->orWhere('LastName', 'like', "{$search}%")
                        ->orWhere('EmailAddress', 'like', "{$search}%");
                });
            });
        }

        $members = $query->cursorPaginate($perPage);

        return MemberResource::collection($members);
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
