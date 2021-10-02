<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User2;
use App\Models\Toukou;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myUserId = Auth::id();
        dd($myUserId);
        $myUserId = 1;
        $toukou = new Toukou();
        $toukouData = $toukou
            ->join('users', 'toukou.userId', '=', 'users.id')
            ->where('userId', $myUserId)
            ->orderBy('hi', 'desc')
            ->get();

        return response()->json(['toukouData' => $toukouData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $replycontent = $request->input('replycontent');
        $mototoukouId= $request->input('mototoukouId');

        if($replycontent){
            $hi = Carbon::now();
            $toukou = new Toukou();
            $toukou->create(['userId' => 1,'originalToukouId' => $mototoukouId,'contents' => $replycontent,'hi' => $hi]);
            $ret = true;
        }else{
            $ret = false;
        }

        return response()->json(['result' => $ret]);
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

    public function login(Request $request)
    {
//        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $user = new User2();
        $user_data = $user
            ->where("password","=",$password)
            ->get();
//        $token = $user_data->api_token;
        return response()->json(['result' => $user_data]);
    }
}
