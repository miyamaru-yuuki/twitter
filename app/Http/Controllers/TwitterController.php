<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toukou;
use App\Models\Follow;
use App\Models\User2;
use Carbon\Carbon;

session_start();
session_regenerate_id(true);
setcookie(session_name(),session_id(),time()+60*60*24*3);

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User2();

        if(isset($_SESSION['address'],$_SESSION['password'])){
            $address = $_SESSION['address'];
            $password = $_SESSION['password'];

            //ログイン処理
            $loginUser = $user
                ->where('email', $address)
                ->where('password', $password)
                ->get();
            $myUserId = $loginUser[0]->id;
            $followIdArray = array();
            array_push($followIdArray,$myUserId);
            $toukou = new Toukou();
            $follow = new Follow();

            $followId = $follow
                ->select('followUserId')
                ->where('myUserId', $myUserId)
                ->get();

            foreach ($followId as $follow){
                array_push($followIdArray,$follow->followUserId);
            }

            //返信ではないツイート
            $originalToukouList = $toukou
                ->join('users', 'toukou.userId', '=', 'users.id')
                ->whereIn('userId',$followIdArray)
                ->whereNull('originalToukouId')
                ->get();

            //返信
            $replyList = $toukou
                ->join('users', 'toukou.userId', '=', 'users.id')
                ->whereNotNull('originalToukouId')
                ->get();

            foreach ($replyList as $reply){
                foreach ($originalToukouList as $originalToukou){
                    if($reply->originalToukouId == $originalToukou->toukouId){
                        $originalToukou->replyName = $reply->name;
                        $originalToukou->replyHi = $reply->hi;
                        $originalToukou->replyContents = $reply->contents;
                        $originalToukou->replyToukouId = $reply->toukouId;
                    }
                }
            }
            $originalToukouList = true;
        }

        $originalToukouList = false;

        return response()->json(['toukouData' => $originalToukouList]);
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
}
