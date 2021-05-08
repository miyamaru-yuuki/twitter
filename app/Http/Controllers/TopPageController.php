<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Toukou;
use App\Models\User2;
use App\Models\Follow;
use Carbon\Carbon;

class TopPageController extends Controller
{
    public function index(Request $request)
    {
        $postcontents = '';
        $toukou = new Toukou();
        $user = new User2();
        $follow = new Follow();
        $search = "";
        $followId = array();

        // セッションIDの再発行
        $request->session()->regenerate();

        if($request->isMethod('post')){
            if($request->input('address') && $request->input('password')) {
                $address = $request->input('address');
                $password = sha1($request->input('password'));

                // ログイン処理
                $loginUser = $user
                    ->where('email', $address)
                    ->where('password', $password)
                    ->get();

                if ($loginUser[0]->id) {
                    //ログイン成功
                    $myUserId = $loginUser[0]->id;
                    // ユーザーIDをセッションへ保存する
                    session(['id' => $myUserId]);
                } else {
                    //ログイン失敗
                    return view('login');
                }
            }
        }

        $name = $user
            ->select('name')
            ->where('id', session('id'))
            ->get();
        $name = $name[0]['name'];

        if($request->isMethod('get')){
            $search = $request->query('search');
        }

        if($request->isMethod('post')){
            if($request->input('userId')){
                $userId = $request->input('userId');
                $hantei = $follow
                    ->where('myUserId', session('id'))
                    ->where('followUserId', $userId)
                    ->get();
                if(isset($hantei[0])){
                    $follow
                        ->where('myUserId', session('id'))
                        ->where('followUserId', $hantei[0]['followUserId'])
                        ->delete();
                }else{
                    $follow->create(['myUserId' => session('id'),'followUserId' => $userId]);
                }
            }
            if($request->input('postcontents')){
                $postcontents = $request->input('postcontents');
                $hi = Carbon::now();
                $toukou->create(['userId' => session('id'),'originalToukouId' => NULL,'contents' => $postcontents,'hi' => $hi]);
            }
        };

        $followList = $follow
            ->where('myUserId', session('id'))
            ->get();

        $userList = $user
            ->whereNotIn('id',[session('id')])
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

        return view('index', ['postcontents' => $postcontents,'userList' => $userList,'search' => $search,'name' => $name]);
    }
}