<?php

namespace App\Http\Controllers;
use Socialite;
use App\follower;
use App\creator;
use App\User;
// use App\Notifications\Templatenotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Notifications\membership_expired;

class HomeController extends Controller
{
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        
        // dd();
        $date = date("Y-m-d");
        $ifmember = DB::table('memberships')->whereRaw('memberships.id_user = ('.Auth::user()->id.') AND memberships.status = 1 ')->get();

        if (isset($ifmember)) {
            foreach ($ifmember as $ifmembers) {
                if ($ifmembers->tenggatwaktu < $date) {
                    DB::table('memberships')->where('id',$ifmembers->id)->update([
                        'status' => 0,
                        ]);

                        //ambildata
                        $creatora = DB::table('creators')->where('id', '=',$ifmembers->id_creator)->first();
                        $creatorsa = DB::table('users')->where('id', '=',$creatora->ID_USER)->first();
                        $paket = DB::table('paket')->where('id', '=',$ifmembers->paket)->first();

                        //sendnotif
                        $data = [ 
                            'creatorname' => $creatora->name,
                            'paket' =>  $paket->nama_paket
                           ];
                        $user = new User();
                        $user->email = $creatorsa->email;   // This is the email you want to send to.
                        $user->notify(new membership_expired($data));
                        // dd($creatorsa);
                }
            }
    }
           
                    
        $user = DB::table('users')->where([['id', '=',Auth::user()->id]])->get();
        $datas = [];
        $foll = [];
        $followi =[];
        $member =[];

        // dd($data);

        $id_creator;
        $User = User::where('id', Auth::user()->id)->get();
        foreach ($User as $Users) {
            // $followers = explode(",", $follower);
            $id_creator = $Users->id;
        }

        $id_followcreator = "";
        $id_followcreators = "";
        $following = follower::where('id_user', Auth::user()->id)->get();
           if ($following !== "") {
        // dd($following);

            # code...
            foreach ($following as $followings) {
            $id_followcreators = $followings->id_following;
            $id_followcreator = explode(",", $id_followcreators);
        }
         // dd($id_followcreator);
            if ($id_followcreators != "") {
                $datas []= "hah";

                    foreach ($id_followcreator as $follow) {
                        $follos = DB::table('creators')->where('id', '=',$follow)->get();
                        $followi = DB::table('creators')->whereRaw('id IN ('.$id_followcreators.')')->paginate(5);
                        foreach ($follos as $keys) {
                            $foll[] = $keys;
                        }
                        $member = DB::table('memberships')->whereRaw('memberships.id_user = ('.Auth::user()->id.') AND memberships.status = 1 ')->join('creators', 'memberships.id_creator', '=', 'creators.id')->select('memberships.*', 'creators.name', 'creators.photo')->paginate(5);
                        $ifmember = 0;
                        $idpaket = '0';
                        $idcreator = '0';
                        foreach ($member as $keys) {
                            $ifmember = $keys->id_creator;
                            $idpaket =  $idpaket.','.$keys->paket;
                            $idcreator = $idcreator.','.$keys->id_creator;
                        }
                            $data = DB::table('posts')->whereRaw('IF(posts.ID_CREATOR IN ('.$id_followcreators.'), posts.privilage = -1 or posts.privilage IN ('.$idpaket.'), posts.privilage = -1) OR IF(posts.ID_CREATOR IN ('.$idcreator.') AND memberships.status = 1, posts.privilage = -1 or posts.privilage IN ('.$idpaket.') or posts.privilage = -2 and posts.ID_CREATOR IN ('.$idcreator.'), posts.privilage = -1) ')->leftJoin('memberships', 'posts.ID_CREATOR', '=', 'memberships.id_creator')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);



                        // array_push($datas,$data);

                        $i = 0;
                        foreach ($data as $keys) {
                            $iflike = false;
                            $id_post = "";
                            $kodecreator;
                            $likes = DB::table('likes')->where([['id_user', '=',Auth::user()->id]])->get();
                            $creatorss = $keys->name;
                            $hash = md5($creatorss);
                            $data[$i]->kode = $hash;
                            if ($likes !== "") {
                                // dd($following);

                                    # code...
                                    foreach ($likes as $like) {
                                    $id_post = $like->id_post;
                                }
                                $id_posts = explode(",", $id_post);

                                }
                                if ($id_posts != "") {

                                    foreach ($id_posts as $key ) {
                                        if ($key == $keys->id) {
                                            // dd($keys->id.'-'.$i);
                                        $data[$i]->iflikes = true;

                                        }else {}

                                    }



                                }

                                $i++;

                        }
                       $datas[] = $data;


                    }
                    }


           }

                    if (empty($datas[1])) {
                        return view('user/home',['data' => $datas,'user' => $user,'follow' => $followi,'member' => $member]);
                    }else{
                        return view('user/home',['data' => $datas[1],'user' => $user,'follow' => $followi,'member' => $member]);
                    }


    }





    public function halkreator()
    {
        $datas = [];
        $user = DB::table('creators')->where([['ID_USER', '=',Auth::user()->id]])->get();
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators) {
            $id_creator = $creators->id;
        }
        $paket = DB::table('paket')->where('paket.ID_CREATOR', '=',$id_creator)->orderBy('id', 'desc')->get();

        $member = DB::table('memberships')->whereRaw('memberships.id_user = ('.Auth::user()->id.') AND memberships.status = 1 ')->join('creators', 'memberships.id_creator', '=', 'creators.id')->select('memberships.*', 'creators.name', 'creators.photo')->paginate(5);
        $ifmember = 0;
        $idpaket = '0';
        $idcreator = '0';
        foreach ($member as $keys) {
            $ifmember = $keys->id_creator;
            $idpaket =  $idpaket.','.$keys->paket;
            $idcreator = $idcreator.','.$keys->id_creator;
        }

        $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);
                        // array_push($datas,$data);
                        $i = 0;
                        foreach ($data as $keys) {
                            $iflike = false;
                            $id_post = "";
                            $likes = DB::table('likes')->where([['id_user', '=',Auth::user()->id]])->get();
                            if ($likes !== "") {
                                // dd($following);

                                    # code...
                                    foreach ($likes as $like) {
                                    $id_post = $like->id_post;
                                }
                                $id_posts = explode(",", $id_post);

                                }
                                if ($id_posts != "") {

                                    foreach ($id_posts as $key ) {
                                        if ($key == $keys->id) {
                                            // dd($keys->id.'-'.$i);
                                        $data[$i]->iflikes = true;

                                        }else {}

                                    }



                                }

                                $i++;

                        }
                       $datas[] = $data;

            return view('kreator/home',['data' => $data,'user' => $user,'paket' => $paket]);

    }







    public function halpaketkreator(Request $request)
    {
        $datas = [];
        $user = DB::table('creators')->where([['ID_USER', '=',Auth::user()->id]])->get();
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators) {
            $id_creator = $creators->id;
        }
        $paket = DB::table('paket')->where('paket.ID_CREATOR', '=',$id_creator)->orderBy('id', 'desc')->get();

if ($request->get('pakets') == "semua") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}elseif ($request->get('pakets') == "publik") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->where('posts.privilage', '=','-1')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}elseif ($request->get('pakets') == "member") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->where('posts.privilage', '=','-2')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}elseif ($request->get('pakets') == "paket") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->where('posts.privilage', '!=','-1')->where('posts.privilage', '!=','-2')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}

                        // array_push($datas,$data);
                        $i = 0;
                        foreach ($data as $keys) {
                            $iflike = false;
                            $id_post = "";
                            $likes = DB::table('likes')->where([['id_user', '=',Auth::user()->id]])->get();
                            if ($likes !== "") {
                                // dd($following);

                                    # code...
                                    foreach ($likes as $like) {
                                    $id_post = $like->id_post;
                                }
                                $id_posts = explode(",", $id_post);

                                }
                                if ($id_posts != "") {

                                    foreach ($id_posts as $key ) {
                                        if ($key == $keys->id) {
                                            // dd($keys->id.'-'.$i);
                                        $data[$i]->iflikes = true;

                                        }else {}

                                    }



                                }

                                $i++;

                        }
                       $datas[] = $data;

            return view('kreator/home',['data' => $data,'user' => $user,'paket' => $paket]);

    }

    // public function lihatkreator($id)
    // {
    //     $iff = false;
    //     $creator = creator::where('id', $id)->get();
    //     $id_creator = 0;
    //     $creators = creator::where('ID_USER', Auth::user()->id)->get();
    //     foreach ($creators as $creatorsa) {
    //         if ($creatorsa->id == $id) {
    //             $id_creator = $creatorsa->id;
    //         }
    //     }

    //     $follower;

    //     $iffollow = DB::table('followers')->where('id_user', Auth::user()->id)->get();

    //     if (isset($iffollow)) {
    //         foreach ($iffollow as $ids) {
    //             $follower = $ids->id_following;
    //         }
    //         $followers = explode(",", $follower);
    //         // dd($followers);
    //         if (in_array($id, $followers)) {
    //             $iff = true;
    //         }
    // }

    //     // dd([ $id_creator,$id]);
    //     $data = DB::table('posts')->where([['ID_CREATOR', '=', $id]])->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*', 'creators.*')->orderBy('posts.created_at', 'desc')->get();
    //     // dd($data);

    //         return view('kreator/home',['data' => $data,'user' => $creator,'ifcreator' => $id_creator,'iffollow' => $iff]);

    // }
}
