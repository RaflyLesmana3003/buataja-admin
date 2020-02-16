<?php

namespace App\Http\Controllers;
use App\creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Notifications\penarikan_saldo;

use Illuminate\Support\Facades\Auth;
use Socialite;


class CreatorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function penarikan(Request $request)
    {

        $password="0";
        $passwords=$request->get('password');
      // code...
      $user = DB::table('users')->whereRaw('id = ('.Auth::user()->id.') ')->get();
      foreach ($user as $users) {
        if (Hash::check( $passwords,$users->password)) {
            $kreator = 0;
      $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
      foreach ($creator as $key) {
          $kreator = $key->id;
          $getsaldo = $key->saldo;
      }

      

      $fees = str_replace(".","",$request->get('jumlah'));

      $fee = intval($fees) * 0.03;
      $total = intval($fees) - intval($fee);
      if (intval($getsaldo) < intval($fees)) {
        return response(['data'=>"permintaan penarikan tidak sesuai dengan total saldo",'tipe'=>"danger"], 404);
      }
      $updatesaldo = intval($getsaldo) - intval($fees);
      DB::table('creators')->where('id',$kreator)->update([
        'saldo' =>  $updatesaldo,
        ]);
    //   $fee = $fee.'000';
      DB::table('withdrawals')->insert([
        'ID_CREATOR' =>$kreator,
        'fee' =>number_format(intval($fee),2,',','.'),
        'jumlah' =>number_format(intval($fees),2,',','.'),
        'total' =>number_format(intval($total),2,',','.'),
        'atas_nama' =>$request->get('atasnama'),
        'bank' =>$request->get('bank'),
        'rekening_tujuan' =>$request->get('norekening'),
        'status' =>1,
        'created_at' =>now(),
        ]);

        

        $creatora = DB::table('creators')->where('id', '=',$kreator)->first();
        $creatorsa = DB::table('users')->where('id', '=',$creatora->ID_USER)->first();

     $data = [ 
        'date' => date("Y-m-d"),
        'namacreator' =>$creatora->name,
        'fee' =>number_format(intval($fee),2,',','.'),
        'jumlah' =>number_format(intval($fees),2,',','.'),
        'total' =>number_format(intval($total),2,',','.'),
       ];
       


      $user = new User();
      $user->email = $creatorsa->email;   // This is the email you want to send to.
      $user->notify(new penarikan_saldo($data));
        }else{
          return response(['data'=>"password salah",'tipe'=>"danger"], 404);
        }
      }
      

      
    }

public function databank(Request $request)
{
  // code...
  DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->update([
    'atasnama' =>$request->get('atasnama'),
    'bank' =>$request->get('bank'),
    'norekening' =>$request->get('norekening'),

    ]);
}
public function saldotarik()
{
    $kreator = 0;
      $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
      foreach ($creator as $key) {
          $kreator = $key->id;
      }
  // code...
  $pendapatan = DB::table('creators')->where('id', '=', $kreator)->sum('saldo');
      $pendapatan = (int)$pendapatan;
      $pendapatan = number_format($pendapatan,2,",",".");
  $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
  return view('kreator/tariksaldo',['creator' => $creator,'pendapatan' => $pendapatan]);
}
public function saldo()
    {
      // code...
      $follow;
      $members;
      $i = 0;
      $kreator = 0;
      $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
      foreach ($creator as $key) {
          $kreator = $key->id;
      }
      $pendapatan = DB::table('creators')->where('id', '=', $kreator)->sum('saldo');
      $pendapatan = (int)$pendapatan;
      $pendapatan = number_format($pendapatan,2,",",".");
      $transaksi = DB::table('transaksis')->where('transaksis.ID_CREATOR', '=', $kreator)->where('status', '=', "success")->join('users', 'transaksis.ID_USER', '=', 'users.id')->join('paket', 'transaksis.ID_PAKET', '=', 'paket.id')->select('transaksis.*','paket.nama_paket','users.name','users.email','users.photo')->orderBy('transaksis.created_at', 'desc')->get();
      $with = DB::table('withdrawals')->where('withdrawals.ID_CREATOR', '=', $kreator)->join('bank', 'withdrawals.bank', '=', 'bank.code')->orderBy('created_at', 'desc')->get();
// dd($with);
return View("kreator/saldo",['creator' => $creator,'with'=>$with,'pendapatan'=>$pendapatan,'transaksi'=>$transaksi]);
    }

    public function dashboard()
    {
      // code...
      
      $i = 0;
      $a = 0;
      $kreator = 0;
      $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
      foreach ($creator as $key) {
          $kreator = $key->id;
      }
      $followers = DB::table('followers')->select('id_user','id_following')->where('id_following', 'LIKE', '%'.$kreator.'%')->get();
      $follow;
      foreach ($followers as $key) {
          $user = DB::table('users')->where('id', '=',$key->id_user)->select('id','name','email','photo')->get();

          $follow[$a] = $user;
          $a++;
        }

      $pendapatan = DB::table('creators')->where('id', '=', $kreator)->sum('saldo');

      $pendapatan = (int)$pendapatan;
      $pendapatan = number_format($pendapatan,2,",",".");
      $view = DB::table('posts')->where('ID_CREATOR', '=', $kreator)->avg('view');
      $views = (int)$view;
      // foreach ($followers as $key) {
      //     $user = DB::table('users')->where('id', '=',$key->id_user)->select('id','name','email','photo')->get();
      //     $follow[] = $user[0];
      // }
      $member = DB::table('memberships')->where('id_creator', '=', $kreator)->get();


      foreach ($member as $key) {
          $user = DB::table('users')->where('id', '=',$key->id_user)->select('id','name','email','photo')->get();
          $member[$i]->user = $user[0];
            // code...
            $paket = DB::table('paket')->where('id', '=',$key->paket)->get();
            foreach ($paket as $keys) {

              $member[$i]->paket = $keys->nama_paket;
          }
          $members[] = array($member[$i]);

$i++;
}

// dd($follow);
        if (!isset($members) && !isset($follow)) {
            # code...
           return View("kreator/dashboard",['creator' => $creator,'pendapatan'=>$pendapatan,'view'=>$views]);

        }
        elseif (isset($members) && isset($follow)) {
            # code...
           return View("kreator/dashboard",['creator' => $creator,'follow'=>$follow,'member'=>$members,'pendapatan'=>$pendapatan,'view'=>$views]);

        }
        elseif (!isset($members)) {
            # code...
           return View("kreator/dashboard",['creator' => $creator,'follow'=>$follow,'pendapatan'=>$pendapatan,'view'=>$views]);

        }elseif (!isset($follow)) {
            # code...
           return View("kreator/dashboard",['creator' => $creator,'member'=>$members,'pendapatan'=>$pendapatan,'view'=>$views]);

        }
// dd($members);

    }

    public function verifikasi()
    {
      // code...
      return View("kreator/verifikasi");

    }

    public function verifikasisubmit(Request $request)
    {
      // code...
      $ktp = $request->file('ktp');

      if ($ktp === "undefined")
      {
          return response(['data'=>"ktp tidak boleh kosong",'tipe'=>"danger"], 404);

      }
      else
      {
              $ktps = "ktp" . time() . Auth::user()->id . $ktp->getClientOriginalName();

              $ext = pathinfo($ktps, PATHINFO_EXTENSION);
                  if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                      $ktp->move(storage_path('/app/public/file/verify') , $ktps);
                      }else{
                          return response(['data'=>"ktp harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                      }


      }
      $selfie = $request->file('selfie');

      if ($selfie === "undefined")
      {
          return response(['data'=>"foto selfie tidak boleh kosong",'tipe'=>"danger"], 404);

      }
      else
      {
              $selfies = "selfie" . time() . Auth::user()->id . $selfie->getClientOriginalName();

              $ext = pathinfo($selfies, PATHINFO_EXTENSION);
                  if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                      $selfie->move(storage_path('/app/public/file/verify') , $selfies);
                      }else{
                          return response(['data'=>"ktp harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                      }


      }
      $ktpse = $request->file('ktpselfie');

      if ($ktpse === "undefined")
      {
          return response(['data'=>"ktp tidak boleh kosong",'tipe'=>"danger"], 404);

      }
      else
      {
              $ktpses = "ktpselfie" . time() . Auth::user()->id . $ktpse->getClientOriginalName();

              $ext = pathinfo($ktps, PATHINFO_EXTENSION);
                  if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                      $ktpse->move(storage_path('/app/public/file/verify') , $ktpses);
                      }else{
                          return response(['data'=>"ktp harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                      }


      }
      $rek = $request->file('rekening');

      if ($rek === "undefined")
      {
          return response(['data'=>"ktp tidak boleh kosong",'tipe'=>"danger"], 404);

      }
      else
      {
              $reks = "rekening" . time() . Auth::user()->id . $rek->getClientOriginalName();

              $ext = pathinfo($ktps, PATHINFO_EXTENSION);
                  if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                      $rek->move(storage_path('/app/public/file/verify') , $reks);
                      }else{
                          return response(['data'=>"ktp harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                      }


      }

      DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->update([
        'ktp' =>$ktps,
        'wajah' =>$selfies,
        'wajahktp' =>$ktpses,
        'rekening' =>$reks,

        ]);
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);


        return redirect('gabung/4');

    }

    public function findOrCreateUser($user, $provider)
    {
        //dd($user, $provider);

        DB::table('users')->where('id', '=',Auth::user()->id)->update([
                'idfacebook' =>$user->id,
          ]);

         // $authUser = User::where('provider_id', $user->id)->first();
        // if ($authUser) {
        //     return $authUser;
        // }
        // else{
        //     $data = User::create([
        //         'name'     => $user->name,
        //         'email'    => !empty($user->email)? $user->email : '' ,
        //         'provider' => $provider,
        //         'provider_id' => $user->id
        //     ]);

        //     $data = User::create([
        //         'name'     => $user->name,
        //         'email'    => !empty($user->email)? $user->email : '' ,
        //         'provider' => $provider,
        //         'provider_id' => $user->id
        //     ]);
        //     return $data;
        // }
        }

    public function disconnect($providers)
    {
        //dd($user, $provider);
        $provider = 'id'.$providers;
        DB::table('users')->where('id', '=',Auth::user()->id)->update([
                $provider => null,
          ]);

          return redirect('gabung/4');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gabung($kode)
    {
        //

        $status = 0;
        $level = 0;
        $nama = null;
        $data = DB::table('creators')->where([
            ['creators.ID_USER', '=',Auth::user()->id],
        ])->join('users', 'users.id', '=', 'creators.ID_USER')->select('creators.*', 'users.idfacebook', 'users.level')->get();

    //    dd($data);

    foreach ($data as $datas) {
        $level = $datas->level;
        $nama = $datas->name;
    }

        // return redirect('/');0
        if ($level == 0) {
            if ($kode == 1) {
                # code...
                return View("kreator/gabung/gabung1",['data' => $data,'status' => $status]);

            }elseif ($kode == 2) {
                # code...
                if ($nama == "" || $nama == null) {
                    return View("kreator/gabung/gabung1",['data' => $data,'status' => $status]);


                }else {
                    return View("kreator/gabung/gabung2",['data' => $data,'status' => $status]);

                }
            }elseif ($kode == 3) {
                # code...
                if ($nama == "" || $nama == null) {
                    return View("kreator/gabung/gabung1",['data' => $data,'status' => $status]);


                }else {
                    return View("kreator/gabung/gabung3",['data' => $data,'status' => $status]);

                }
            }elseif ($kode == 4) {
                 # code...
                 if ($nama == "" || $nama == null) {
                    return View("kreator/gabung/gabung1",['data' => $data,'status' => $status]);


                }else {
                    return View("kreator/gabung/gabung4",['data' => $data,'status' => $status]);

                }
            }elseif ($kode == 5) {
                 # code...
                 if ($nama == "" || $nama == null) {
                    return View("kreator/gabung/gabung1",['data' => $data,'status' => $status]);


                }else {
                    return View("kreator/gabung/gabung5",['data' => $data,'status' => $status]);

                }

            }
        }else {
            return redirect('edit');

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function photo(Request $request)
    {
        // dd($request);
        $pp = "";
        $ppa = null;
        $cppa = 0 ;
        $co = "";
        $cover = null;
        $ccover = 0 ;
        $dbpp = "";
        $dbcover = "";

        $data = DB::table('creators')->where([
            ['ID_USER', '=',Auth::user()->id]
        ])->get();

        foreach ($data as $datas) {
            $dbpp = $datas->photo;
            $dbcover = $datas->cover;
        }

        $pp = $request->pp;
        if ($pp === "undefined") {
        }else {
            $ppa = "pp".time().Auth::user()->id.$pp->getClientOriginalName();
            $cppa = 1 ;

        $pp->move(storage_path('/app/public/file/pp'),$ppa);
        if ($cppa == 1) {
            if ($dbpp != "") {
                $filename =  $ppa;
                $path=storage_path('/app/public/file/pp/').$dbpp;
                if (file_exists($path)) {
                    unlink($path);
            }

        }
        DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->update([
            'photo' => $ppa
      ]);
        }
        }

        $co = $request->cover;
        if ($co === "undefined") {
        }else {
            $cover = "cover".time().Auth::user()->id.$co->getClientOriginalName();
            $ccover = 1 ;
            $co->move(storage_path('/app/public/file/pp'),$cover);
            if ($ccover == 1) {
                if ($dbcover != "") {

            $path=storage_path('/app/public/file/pp/').$dbcover;
            if (file_exists($path)) {
                unlink($path);
            }
            }
            DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->update([
                'cover' => $cover,
          ]);
        }
        }









        //

    }

    public function photo_user(Request $request)
    {
        // dd($request);
        $pp = "";
        $ppa = null;
        $cppa = 0 ;
        $co = "";
        $cover = null;
        $ccover = 0 ;
        $dbpp = "";
        $dbcover = "";

        $data = DB::table('users')->where([
            ['id', '=',Auth::user()->id],
        ])->get();

        foreach ($data as $datas) {
            $dbpp = $datas->photo;
            $dbcover = $datas->cover;
        }

        $pp = $request->pp;
        if ($pp === "undefined") {
        }else {
            $ppa = "pp".time().Auth::user()->id.$pp->getClientOriginalName();
            $cppa = 1 ;

        $pp->move(storage_path('/app/public/file/pp'),$ppa);
        if ($cppa == 1) {
            if ($dbpp != "") {
                $filename =  $ppa;
                $path=storage_path('/app/public/file/pp/').$dbpp;
                if (file_exists($path)) {
                    unlink($path);
            }

        }
        DB::table('users')->where('id',Auth::user()->id)->update([
            'photo' => $ppa
      ]);
        }
        }

        $co = $request->cover;
        if ($co === "undefined") {
        }else {
            $cover = "cover".time().Auth::user()->id.$co->getClientOriginalName();
            $ccover = 1 ;
            $co->move(storage_path('/app/public/file/pp'),$cover);
            if ($ccover == 1) {
                if ($dbcover != "") {

            $path=storage_path('/app/public/file/pp/').$dbcover;
            if (file_exists($path)) {
                unlink($path);
            }
            }
            DB::table('users')->where('id',Auth::user()->id)->update([
                'cover' => $cover,
          ]);
        }
        }









        //

    }

    public function create(Request $request)
    {



            DB::table('creators')->where('ID_USER',Auth::user()->id)->update([

                    'name' => $request->get('name'),
                    'ID_USER' => Auth::user()->id,
                    'kreasi' => $request->get('kreasi'),
                    'desc' => $request->get('desc'),
                    'nudity' => $request->get('nudity'),
              ]);

        //

    }



    public function createkreator(Request $request)
    {

        //
        $Data = $request->Data;



         $data = creator::where('ID_USER', Auth::user()->id)->first();
             // dd($data);

             if ($Data['kode'] == 1) {
                if (!$data) {
                    $na = creator::where('name', $Data['name'])->first();

                    if (!$na) {
                        DB::table('creators')->insert([

                            'name' => $Data['name'],
                            'ID_USER' => Auth::user()->id,

                       ]);
                    }else{
                        return response(['data'=>"nama kreator sudah dipakai",'tipe'=>"danger"], 404);
                    }



              }
              else{
                  DB::table('creators')->where('ID_USER',Auth::user()->id)->update([

                     'name' => $Data['name'],
                         'ID_USER' => Auth::user()->id,
                    ]);
              }
            }elseif ($Data['kode'] == 2) {
                # code...
                if (!$data) {

                    DB::table('creators')->insert([
                         'kreasi' => $Data['kreasi'],

                    ]);
              }
              else{
                  DB::table('creators')->where('ID_USER',Auth::user()->id)->update([

                         'kreasi' => $Data['kreasi']
                    ]);
              }
            }elseif ($Data['kode'] == 3) {
                # code...
                if (!$data) {

                    DB::table('creators')->insert([

                         'nudity' => $Data['nudity']

                    ]);


              }
              else{
                  DB::table('creators')->where('ID_USER',Auth::user()->id)->update([

                         'nudity' => $Data['nudity'],
                    ]);
              }
            }
            elseif ($Data['kode'] == 5) {
               DB::table('users')->where('id',Auth::user()->id)->update([

                'level' => 1,
               ]);
            }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function show(creator $creator)
    {
        //
    }

    public function hal_edit()
    {
        $status = 0;
        $id_creator;
        $paketcreator= [];
        $benepaketcreator= [];
        $user = DB::table('users')->where([
            ['id', '=',Auth::user()->id],
        ])->get();;

        $data = DB::table('creators')->where([
            ['creators.ID_USER', '=',Auth::user()->id],
        ])->join('users', 'users.id', '=', 'creators.ID_USER')->select('creators.*', 'users.level', 'users.idfacebook')->get();
        foreach ($data as $id) {
           $id_creator = $id->id;
        }
        // dd($id_creator);


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

        if ($data === null) {

            $status = 1;
         }
        // return redirect('/');
        return View("kreator/edithalaman",['data' => $data,'status' => $status,'user' => $user,'paket' => $paket]);
    }

    public function hal_edit_user()
    {
        $status = 0;
        $user = DB::table('users')->where([
            ['id', '=',Auth::user()->id],
        ])->get();;

        $data = DB::table('creators')->where([
            ['creators.ID_USER', '=',Auth::user()->id],
        ])->join('users', 'users.id', '=', 'creators.ID_USER')->select('creators.*', 'users.*')->get();;

        if ($data === null) {

            $status = 1;
         }
        // dd($user);
        // return redirect('/');
        return View("user/edit",['data' => $data,'status' => $status,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function edit(creator $creator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, creator $creator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function destroy(creator $creator)
    {
        //
    }
    public function like(Request $request)
    {

        $Data = $request->Data;
        //
        $post = 0;

        $data = DB::table('posts')->where([['id', '=', $Data['id']], ])->get();
        foreach ($data as $posts)
        {
            $post = $posts->like;
            $post = $post + 1;
            $postli = $post;
        }
        DB::table('posts')->where('id', '=', $Data['id'])->update(['like' => $post, ]);

        $likes = DB::table('likes')->where('id_user', '=', Auth::user()
            ->id)
            ->first();
        if ($likes == null)
        {
            DB::table('likes')->insert([['id_user' => Auth::user()->id, 'id_post' => $Data['id'], ]]);
        }
        else
        {
            $idpost;
            $likes = DB::table('likes')->where('id_user', '=', Auth::user()
                ->id)
                ->get();
            foreach ($likes as $like)
            {
                $idpost = $like->id_post;
            }

            DB::table('likes')
                ->where('id_user', Auth::user()
                ->id)
                ->update(['id_post' => $idpost . ',' . $Data['id'], ]);
        }
        return $postli;


    }
    public function unlike(Request $request)
    {
        $Data = $request->Data;

        $post = 0;
        $data = DB::table('posts')->where([['id', '=', $Data['id']], ])->get();
        foreach ($data as $posts)
        {
            $post = $posts->like;
            $post = $post - 1;
            $postli = $post;
        }
        DB::table('posts')->where('id', '=', $Data['id'])->update(['like' => $post, ]);

        $idpost = DB::table('likes')->where('id_user', Auth::user()
            ->id)
            ->get();

        if (isset($idpost))
        {
            foreach ($idpost as $ids)
            {
                $idp = $ids->id_post;
            }
            $idposts = explode(",", $idp);
            if (($key = array_search($Data['id'], $idposts)) !== false)
            {
                unset($idposts[$key]);
            }
            $post = implode(",", $idposts);
        }
        DB::table('likes')->where('id_user', Auth::user()
            ->id)
            ->update(['id_post' => $post, ]);

        return $postli;

    }
}
