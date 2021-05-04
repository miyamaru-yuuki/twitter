<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toukou;
use App\Models\Follow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // セッションIDの再発行
        Session::regenerate();

        if(Session::has('id')){
            $myUserId = session('id');
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
            return response()->json(['toukouData' => $originalToukouList]);
        }else{
            return response()->json(['ret' => false]);
        }
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
