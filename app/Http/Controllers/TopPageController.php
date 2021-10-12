<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Toukou;
use App\Models\User2;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TopPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postcontents = '';
        $user = new User2();
        $follow = new Follow();
        $api_token = $request->query('api_token');
        $user_data = User2::where('api_token',"=",hash('sha256', $api_token))->get()->first();
        $myUserId = $user_data->id;
        $search = "";
        $name = $user_data->name;
        $followId = array();

        if($request->isMethod('get')){
            $search = $request->query('search');
        }

        $followList = $follow
            ->where('myUserId', $myUserId)
            ->get();

        $userList = $user
            ->whereNotIn('id',[$myUserId])
            ->where('name', 'like', "%$search%")
            ->get();

        foreach ($userList as $user){
            $user->status = "";
            $user->val = "フォローする";
            foreach ($followList as $follow){
                if($user->id == $follow->followUserId){
                    $user->status = "フォロー中";
                    $user->val = "フォローを解除する";
                }
            }
        }

        foreach ($followList as $follow){
            array_push($followId,$follow->followUserId);
        }

        $toukou = new Toukou();
        $toukouData = $toukou
            ->join('users', 'toukou.userId', '=', 'users.id')
            ->where('userId', $myUserId)
            ->orderBy('hi', 'desc')
            ->get();

        return response()->json(['postcontents' => $postcontents,'userList' => $userList,'search' => $search,'name' => $name,'toukouData' => $toukouData]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
