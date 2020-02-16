<?php

namespace App\Http\Controllers;
use Socialite;
use App\follower;
use App\creator;
use App\membership;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function lihatberlangganan()
    {
        $User = User::where('id', Auth::user()->id)->get();
        $member = DB::table('memberships')->whereRaw('memberships.id_user = ('.Auth::user()->id.') AND memberships.status = 1 ')->join('creators', 'memberships.id_creator', '=', 'creators.id')->select('memberships.*', 'creators.name', 'creators.photo')->paginate(5);


       return view('user/listberlangganan',['user' => $User,'follow' => $member]);
    }
    public function lihatfollowing()
    {
        $User = User::where('id', Auth::user()->id)->get();
        $followi = follower::where('id_user', Auth::user()->id)->get();
        if ($followi !== "") {
            // dd($following);

                # code...
                $id_followcreators = "";
                foreach ($followi as $followings) {
                $id_followcreators = $followings->id_following;
                $id_followcreator = explode(",", $id_followcreators);
            }

             // dd($id_followcreator);
                if ($id_followcreators != "") {
                        foreach ($id_followcreator as $follow) {
                            $follos = DB::table('creators')->where('id', '=',$follow)->get();
                            $followi = DB::table('creators')->whereRaw('id IN ('.$id_followcreators.')')->paginate(10);



                        }
                        }


               }
       return view('user/listfollowing',['user' => $User,'follow' => $followi]);
    }
    public function search(Request $request)
    {
        if ($request->has('key')) {
            $cari = $request->key;
            $data = DB::table('creators')->select('id','name', 'kreasi','photo')->where('name', 'LIKE', '%'.$cari.'%')->orWhere('kreasi', 'LIKE', '%'.$cari.'%')->get();
            // dd( $data);
            return view('page/search',['data' => $data]);
            // dd($$request->defect_type);
        }
        # code...
    }

    public function lihatkreator($id)
    {
        $iff = false;
        $creator = creator::where('id', $id)->get();
        $id_creator = 0;
        if (Auth::user() != null) {
            $creators = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creators as $creatorsa) {
            if ($creatorsa->id == $id) {
                $id_creator = $creatorsa->id;
            }
        }
        }


        $follower = "";
if (Auth::user() != null) {
    $iffollow = DB::table('followers')->where('id_user', Auth::user()->id)->get();
        if (isset($iffollow)) {

            foreach ($iffollow as $ids) {
                $follower = $ids->id_following;
            }
            $followers = explode(",", $follower);
            // dd($followers);
            if (in_array($id, $followers)) {
                $iff = true;
            }
    }
}


        // dd([ $id_creator,$id]);
        $data = DB::table('posts')->where([['ID_CREATOR', '=', $id]])->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*', 'creators.photo', 'creators.name')->orderBy('posts.created_at', 'desc')->paginate(10);
        // dd($data);
        $paket = DB::table('paket')->where('paket.ID_CREATOR', '=',$id)->orderBy('id', 'desc')->get();

            return view('kreator/home',['data' => $data,'user' => $creator,'ifcreator' => $id_creator,'iffollow' => $iff,'paket' => $paket]);

    }

    public function lihatkreatorbynama($nama,Request $request)
    {
        $iff = false;
        $creator = creator::where('name', $nama)->get();



        $id_creator = 0;
        $if_creator = 0;
        foreach ($creator as $creatorsa) {
            if ($creatorsa->name == $nama) {
                $id_creator = $creatorsa->id;
            }else{


            }
        }
        if (Auth::user() != null) {
            $creators = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creators as $creatorsa) {
            if ($creatorsa->name == $nama) {
                $if_creator = $creatorsa->id;
            }else{


            }
        }
        }
        if ($id_creator == 0) {

            abort(404);
        }


        $follower = "";
if (Auth::user() != null) {
    $iffollow = DB::table('followers')->where('id_user', Auth::user()->id)->get();
        if (isset($iffollow)) {

            foreach ($iffollow as $ids) {
                $follower = $ids->id_following;
            }
            $followers = explode(",", $follower);
            // dd($followers);
            if (in_array( $id_creator , $followers)) {
                $iff = true;
            }
    }
}



$ifmember = 0;
$idpaket = '0';
$idcreator = '0';
$i = 0;

if (Auth::user() != null) {
$member = DB::table('memberships')->whereRaw('memberships.id_user = ('.Auth::user()->id.') AND memberships.status = 1 ')->paginate(5);
foreach ($member as $keys) {
    $ifmember = $keys->id_creator;
    $idpaket =  $keys->paket;
    $idcreator = $keys->id_creator;
}}

if ($request->get('pakets') == "semua") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}elseif ($request->get('pakets') == "publik") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->where('posts.privilage', '=','-1')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}elseif ($request->get('pakets') == "member") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->where('posts.privilage', '=','-2')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}elseif ($request->get('pakets') == "paket") {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->where('posts.privilage', '!=','-1')->where('posts.privilage', '!=','-2')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.name', 'creators.photo')->orderBy('posts.created_at', 'desc')->paginate(10);

}else {
  $data = DB::table('posts')->where([['posts.ID_CREATOR', '=', $id_creator]])->Leftjoin('paket', 'posts.privilage', '=', 'paket.id')->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*','paket.nama_paket', 'creators.photo', 'creators.name')->orderBy('posts.created_at', 'desc')->paginate(10);

}
foreach ($data as $keys) {
if ($ifmember == "0") {
  $data[$i]->statusmem = 0;

}elseif ($ifmember != "0") {
  $data[$i]->statusmem = 1;


}if ($idpaket == $keys->privilage) {
  $data[$i]->statuspaket = 1;

}else {
  $data[$i]->statuspaket = 0;

}
$i++;
}
// dd($data);
        $paket = DB::table('paket')->where('paket.ID_CREATOR', '=',$id_creator)->orderBy('id', 'desc')->get();
    //    dd($iff);
            return view('kreator/home',['data' => $data,'user' => $creator,'ifcreator' => $if_creator,'iffollow' => $iff,'paket' => $paket]);

    }

    public function lihatpaketbynama($nama)
    {
        $id_creator = 0;

        $benepaketcreator= [];
        $creator = creator::where('name', $nama)->get();

        foreach ($creator as $creatorsa) {
            if ($creatorsa->name == $nama) {
                $id_creator = $creatorsa->id;
            }else{


            }
        }
        if ($id_creator == 0) {

            abort(404);
        }
        $paket = DB::table('paket')->where('paket.ID_CREATOR', '=',$id_creator)->orderBy('id', 'desc')->get();
        if ($paket !== null) {

            foreach ($paket as $pakets) {
                $idbenefit = $pakets->benefit;
                $bene = explode(",", $idbenefit);
                foreach ($bene as $key) {
                $benefit = DB::table('benefits')->where('benefits.id', '=',$key)->get();
                foreach ($benefit as $keys) {

                array_push($benepaketcreator,$keys);

                 }
                }
                $pakets->benefit = $benepaketcreator;

                $benepaketcreator=[];
                //  array_push($paketcreator, $paketscreator);
             }



        }
        return view('kreator/listpaket',['data'=>$creator,'paket' => $paket]);

    }

}
