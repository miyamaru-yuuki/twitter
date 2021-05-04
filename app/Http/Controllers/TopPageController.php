<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Toukou;
use App\Models\User2;
use App\Models\Follow;
use Carbon\Carbon;

session_start();
session_regenerate_id(true);
setcookie(session_name(),session_id(),time()+60*60*24*3);

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

        if($request->isMethod('post')){
            $_SESSION['address'] = $request->input('address');
            $_SESSION['password'] = sha1($request->input('password'));
        }

        if(isset($_SESSION['address'],$_SESSION['password'])){
            $address = $_SESSION['address'];
            $password = $_SESSION['password'];

            //ログイン処理
            $loginUser = $user
                ->where('email', $address)
                ->where('password', $password)
                ->get();
            $myUserId = $loginUser[0]->id;
            $name = $loginUser[0]->name;
        }else{
            return view('login');
        }

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

        return view('index', ['postcontents' => $postcontents,'userList' => $userList,'search' => $search,'name' => $name]);
    }
}