<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    
    public function create(Request $request)
    {
        $user_id = $request->doctor_id;
        $name = $request->name;
        $image = $request->file('image');
        $link = $request->link;
        $status = 1;

        if ($user_id == NULL || $name == NULL || $image == NULL) {
            return response()->json([
                'result' => false,
                'message' => 'doctor_id, story name and story image fields must provide'
            ],404);
        }
        else {
            $story = new Story();
            $story->user_id = $user_id;
            $story->name = $name;
            $story->link = $link;

            $image = $request->file('image');
            $imagename = time() . '.' . $request->file('image')->getClientOriginalName();
            $image->storeAs('public/story', $imagename);
            $story->image = $imagename;

            $story->status = $status;
            $story->save();

            $story = Story::where('user_id',$user_id)->where('status',1)->orderBy('id','DESC')->latest()->first();

            return response()->json([
                'result' => true,
                'message' => 'story added',
                'story' => $story
            ],200);
        }
    }

    public function stories()
    {
        $stories = Story::get();
        return response()->json([
            'result' => true,
            'image path' =>'/storage/story/',
            'stories' => $stories
        ],200);
    }

    public function activestories1()
    {
        $stories = Story::with('user')->where('status',1)->get();
        return response()->json([
            'result' => true,
            'image path' =>'/storage/story/',
            'stories' => $stories
        ],200);
    }

    public function activestories2()
    {
        $stories = User::join('doctors','doctors.user_id','=','users.id')->with('stories')->select('users.*')->get();
        return response()->json([
            'result' => true,
            'image path' =>'/storage/story/',
            'stories' => $stories
        ],200);
    }

    public function userstories(Request $request)
    {
        $stories = Story::where('status',1)->where('user_id',$request->id)->get();
        return response()->json([
            'result' => true,
            'image path' =>'/storage/story/',
            'stories' => $stories
        ],200);
    }

}
