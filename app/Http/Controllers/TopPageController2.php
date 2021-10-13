<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Toukou;
use App\Models\User2;
use App\Models\Follow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TopPageController2 extends Controller
{
    public function index(Request $request)
    {
        $postcontents = '';
        $toukou = new Toukou();
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

        if($request->isMethod('post')){
            if($request->input('userId')){
                $userId = $request->input('userId');
                $hantei = $follow
                    ->where('myUserId', $myUserId)
                    ->where('followUserId', $userId)
                    ->get();
                if(isset($hantei[0])){
                    $follow
                        ->where('myUserId', $myUserId)
                        ->where('followUserId', $hantei[0]['followUserId'])
                        ->delete();
                }else{
                    $follow->create(['myUserId' => $myUserId,'followUserId' => $userId]);
                }
            }else{
                $postcontents = $request->input('postcontents');
                $hi = Carbon::now();
                $toukou->create(['userId' => 1,'originalToukouId' => NULL,'contents' => $postcontents,'hi' => $hi]);
            }
        };

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

//        $toukouList = $toukou
//            ->join('users', 'toukou.userId', '=', 'users.id')
//            ->where('userId', $myUserId)
//            ->orderBy('hi', 'desc')
//            ->get();

        return view('index', ['postcontents' => $postcontents,'userList' => $userList,'search' => $search,'name' => $name]);
    }

}
