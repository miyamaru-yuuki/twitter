<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User2;
use App\Models\Toukou;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TwitterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->except(['login']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $api_token = $request->query('api_token');

        if (!Hash::check($api_token,Hash::make($api_token))) {
            exit();
        }

        $user_data = User2::whereRaw(Hash::check($api_token,Hash::make($api_token)))->get()->first();
        $myUserId = $user_data->id;
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
    public function show(Request $request)
    {
        $api_token = $request->query('api_token');

        if (!Hash::check($api_token,Hash::make($api_token))) {
            exit();
        }

        $user_data = User2::whereRaw(Hash::check($api_token,Hash::make($api_token)))->get()->first();
        $myUserId = $user_data->id;
        $toukou = new Toukou();
        $toukouData = $toukou
            ->join('users', 'toukou.userId', '=', 'users.id')
            ->where('userId', $myUserId)
            ->orderBy('hi', 'desc')
            ->get();

        return response()->json(['toukouData' => $toukouData]);
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
        $email = $request->input('email');
        $password = $request->input('password');
        $user_data = User2::where('email','=',$email)->get()->first();

        if (Hash::check($password,$user_data->password)) {
            // パスワードが一致
            $api_token = Str::random(80);
            $user_data->api_token = hash('sha256', $api_token);
            $user_data->save();
            $ret = $api_token;
        } else {
            $ret = false;
        }
        return response()->json(['ret' => $ret]);
    }

}
