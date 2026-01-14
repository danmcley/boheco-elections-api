<?php
namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\MemberResource;

class MembersController extends Controller
{
    /**
     * List members (NO validation request here)
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 100);

        $query = Member::query();

        if ($request->filled('town')) {
            $query->where('Town', $request->town);
        }

        if ($request->filled('gender')) {
            $query->where('Gender', $request->gender);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('FirstName', 'like', "%{$search}%")
                  ->orWhere('LastName', 'like', "%{$search}%")
                  ->orWhere('EmailAddress', 'like', "%{$search}%");
            });
        }

        return MemberResource::collection(
            $query->orderBy('Id')->cursorPaginate($perPage)
        );
    }

    /**
     * Store member
     */
    public function store(MemberRequest $request)
    {
        $member = Member::create($request->validated());
        return new MemberResource($member);
    }

    /**
     * Show member
     */
    public function show($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        return new MemberResource($member);
    }

    /**
     * Update member
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->update($request->validated());
        return new MemberResource($member);
    }

    /**
     * Delete member
     */
    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->delete();
        return response()->json(['message' => 'Member deleted successfully']);
    }
}
