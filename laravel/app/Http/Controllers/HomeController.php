<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = \DB::table('users')->Paginate(20);
        return view('home', ['users' => $users]);
    }
    public function profile()
    {
        return view('profile');
    }
    public function uploadAvatar(Request $request)
    {
        if($request->hasFile('file') ){ //only working with correct max file size
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|max:8300|mimes:jpeg,png,jpg',
            ]);
            if ($validator->fails()) {
                return json_encode($validator->errors());
            }else{ //save avatar to storage
                $avatar = $request->file('file');
                $fileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $avatar->getClientOriginalExtension();
                Storage::disk('local')->putFileAs('public/upload/', $avatar, $fileName);
                $storagePath = 'upload/'.$fileName;
                $update = \DB::table('users')
                            ->where('id', '=', \Auth::user()->id)
                            ->update(
                                [
                                    'avatar' => $storagePath,
                                    "updated_at" => \Carbon\Carbon::now(),
                                ]
                            );
                return json_encode(['success' => 'Profile avatar is updated!']);
            }
        }else{
            return json_encode(['error' => 'Profile avatar is not found!']);
        }
        
    }
    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|string',
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors());
        }else{ //save avatar to storage
            $update = \DB::table('users')
                        ->where('id', '=', \Auth::user()->id)
                        ->update(
                            [
                                'phone' => $request->phone,
                                'name' => $request->name,
                                "updated_at" => \Carbon\Carbon::now(),
                            ]
                        );
            return json_encode(['success' => 'Profile information is updated!']);
        }
    }
}
