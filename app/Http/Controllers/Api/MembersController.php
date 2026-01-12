<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::select("SELECT [Id] ,[FirstName] ,[MiddleName] ,[LastName] ,[Suffix] ,[Birthdate] ,[Sitio] ,[Barangay] ,[Town] 
        ,[ContactNumbers],[EmailAddress], [created_at] ,[updated_at] ,[Gender]  FROM [main].[dbo].[CRM_MemberConsumers]");
        $dataFullname = [];
        foreach ($data as $item) {
            $dataFullname[] = $item->FirstName . " " . $item->MiddleName . " " . $item->LastName;
        }
        return response()->json( [
            'FirstName' => $data[0]->FirstName,
            'MiddleName' => $data[0]->MiddleName,
            'LastName' => $data[0]->LastName,
        ]);
    }

    public function store(Request $request)
    {
         $data = $request->validate([
            'title' => 'required|string|min:5',
            'body' => 'required|string|min:10',
        ]);

        // $data['author_id'] = 1; // Placeholder for authenticated user ID

        $post = Post::create($data);

        // return response()->json( [
        //     'id' => 1,
        //     'title' => 'Hello World',
        //     'message' => 'This is the posts index method.'
        // ]);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
         return response()->json( [
            'id' => 1,
            'title' => 'Hello World',
            'message' => 'This is the posts index method.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $data = $request->validate([
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:10',
        ]);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->noContent();
    }
}
