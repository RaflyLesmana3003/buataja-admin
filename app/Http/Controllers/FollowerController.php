<?php

namespace App\Http\Controllers;

use App\follower;
use App\User;
use App\creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Notifications\following;


class FollowerController extends Controller
{
    use Notifiable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function search($page)
    {
        // dd($page);
        $data = DB::table('creators')->select('id','name', 'kreasi','photo')->where('name', 'LIKE', '%'.$page.'%')->orWhere('kreasi', 'LIKE', '%'.$page.'%')->get();
        // dd( $data);
        return view('page/search',['data' => $data]);
        //
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
    public function follow(Request $request)
    {
        $Data = $request->Data;

        // dd($Data['id']);

        $user = DB::table('followers')->where('id_user', Auth::user()->id)->first();

if ($user == null) {
            DB::table('followers')->insert([
              [
                 'id_user' => Auth::user()->id,
                 'id_following' => $Data['id'],
              ]
            ]);
}else{
        $idfollow;
        $follow = DB::table('followers')->where('id_user', Auth::user()->id)->get();
        foreach ($follow as $follows) {
            $idfollow = $follows->id_following;
        }
        if ($idfollow === "") {
            DB::table('followers')->where('id_user',Auth::user()->id)->update([

                'id_user' =>  Auth::user()->id,
                'id_following' => $Data['id'],
                ]);
        }else{
            DB::table('followers')->where('id_user',Auth::user()->id)->update([

                'id_user' =>  Auth::user()->id,
                'id_following' => $idfollow.','.$Data['id'],
                ]);

        }
}

DB::table('creators')->where('id',$Data['id'])->increment('followers');

//send notif
$creator = DB::table('creators')->where('id',$Data['id'])->first();
$creatora = DB::table('users')->where('id',$creator->ID_USER)->first();
$data = [ 
    'username' => Auth::user()->name,
    'creatorname' => $creatora->name
   ];

  $user = new User();
  $user->email = $creatora->email;   // This is the email you want to send to.
  $user->notify(new following($data));
        // if (!$user) {

        // }
        // if ($user){
        //
        // }
    }

    public function unfollow(Request $request)
    {
        $Data = $request->Data;

        $iffollow = DB::table('followers')->where('id_user', Auth::user()->id)->get();

        if (isset($iffollow)) {
            foreach ($iffollow as $ids) {
                $follower = $ids->id_following;
            }
            $followers = explode(",", $follower);
            // dd($followers);
            if (($key = array_search($Data['id'], $followers)) !== false) {
                unset($followers[$key]);
            }
            $follow = implode(",",$followers) ;
    }
            DB::table('followers')->where('id_user',Auth::user()->id)->update([
                    'id_following' => $follow,
                    ]);
                    DB::table('creators')->where('id',$Data['id'])->decrement('followers');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function show(follower $follower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function edit(follower $follower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(follower $follower)
    {
        //
    }
}
