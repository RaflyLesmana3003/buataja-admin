<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/creator/{id}', 'followerController@search');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/8f8fe8570a6fca0299bce1c90079cbe6/{kode}', 'CreatorController@gabung');
Route::post('/844353a0f92c1b37e3842c2cc5cddb67', 'CreatorController@createkreator');

Route::post('/aebd9fb368f2e13b2b2ba624e1a2455e', 'CreatorController@create');
Route::post('/5cbbbf61d2c17842cdb67cb49e0601d1', 'CreatorController@photo');
Route::post('/d33e9b922fce690cfbb1e761fc52d9c7', 'CreatorController@photo_user');
Route::post('/a84c5795d94986ff2dfd1a5907b211a6', 'BenefitController@create');
Route::post('/48dc4d8d68cf1eb740249c19c4cc7304', 'BenefitController@edit');

Auth::routes(['verify' => true]);

Route::get('/106a6c241b8797f52e1e77317b96a201', 'HomeController@index')->name('home');
Route::get('/106a6c241b8797f52e1e77317b96a201/kreator', 'HomeController@halkreator');
// Route::get('/pakets', 'HomeController@halpaketkreator');
// Route::get('/myprofile', function () {
//     return view('user/home');
// });
Route::get('connect/{provider}', 'CreatorController@redirectToProvider');
Route::get('connect/{provider}/callback', 'CreatorController@handleProviderCallback');
Route::get('disconnect/{provider}', 'CreatorController@disconnect');

Route::get('/76ea0bebb3c22822b4f0dd9c9fd021c5', function () {
    return view('content/create');
})->middleware('auth');

// route bikin konten
Route::get('/list/konten', function () {
  $kreator = 0;
  $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
  foreach ($creator as $key) {
      $kreator = $key->id;

  }
  $post = DB::table('posts')->where([['ID_CREATOR', '=',$kreator]])->orderBy('created_at', 'desc')->get();

    return view('content/list',['post' => $post,]);
})->middleware('auth');


Route::get('/76ea0bebb3c22822b4f0dd9c9fd021c5/{jenis}', function ($jenis) {
    $kreator = 0;
    $creator = DB::table('creators')->where('ID_USER', '=',Auth::user()->id)->get();
    foreach ($creator as $key) {
        $kreator = $key->id;

    }
    $paket = DB::table('paket')->where([['ID_CREATOR', '=',$kreator]])->get();
    // dd($paket);
    return view('content/'.$jenis,['paket' => $paket,]);
});


Route::get('/de95b43bceeb4b998aed4aed5cef1ae7','CreatorController@hal_edit');
Route::get('/de95b43bceeb4b998aed4aed5cef1ae7/user','CreatorController@hal_edit_user');

Route::get('/edit/creator/tambahpaket','PaketController@index');

Route::get('/8373f10aa6ee53aeae7dd77fa9a66fd4','PaketController@editbenefit');
Route::post('/f34d39276fcb35adf8943528a023984a','PaketController@create');

Route::get('image/upload','PostController@fileCreate');
Route::post('7af8c017995f445a4d7c7d7735e94226','PostController@tulis');
Route::post('1add3fc77e463ea813e4b0f2d4028fe7','PostController@gambar');
Route::post('421b47ffd946ca083b65cd668c6b17e6','PostController@video');
Route::post('80d5f512d443c9573b5a408fb01d2e3a','PostController@musik');
Route::post('c2ac6f36a89eea3beafc493d61c6f6c6','PaketController@hapus');
Route::post('ebf429e2cc2e4dae0f248cf231c9a932','PostController@hapus');

Route::get('42b90196b487c54069097a68fe98ab6f/{post}', function ($posta) {
    $post = DB::table('posts')->where([['posts.id', '=',$posta]])->join('creators', 'posts.ID_CREATOR', '=', 'creators.id')->select('posts.*', 'creators.name', 'creators.photo')->get();
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
           if ($id_posts !== "") {

               foreach ($id_posts as $key ) {
                if ($key == $posta) {
                    $iflike = true;
                }

               }



           }
DB::table('posts')->where('posts.id', '=',$posta)->increment('view');

return view('content/page',['data' => $post,'likes' => $iflike]);
});

Route::get('kreator/profil/{id}','Controller@lihatkreator');
Route::post('da5e6997913d68b2b6a59381a94e664a','Controller@search');
Route::post('a4010945e4bd924bc2a890a2effea0e6','FollowerController@follow');
Route::post('88d162b834d465685172b3f4978497d2','FollowerController@unfollow');
Route::post('360546da09facea5c42a224ac273c4a6','CreatorController@like');
Route::post('c9974434a9b5e8898f157f45b5575d88','CreatorController@unlike');
Route::post('likecomment/{id}','CommentController@like');
Route::post('unlikecomment/{id}','CommentController@unlike');
Route::post('comment/{id}','CommentController@index');
Route::get('1e71ac120240f553eed34209879fd6e7/{nama}','Controller@lihatpaketbynama');
Route::get('6d2f2f9fc3eb0b0d0ebf36653ad7015e','Controller@lihatfollowing');
Route::get('b84dc340d0bd103ac5a157ce6387ee21','Controller@lihatberlangganan');
Route::get('f2a2dc9c8f00c0aff80756a667123372','CreatorController@verifikasi');
Route::post('7165a9480ff79e065fbf0a9214432f90','CreatorController@verifikasisubmit');
Route::get('dc7161be3dbf2250c8954e560cc35060','CreatorController@dashboard');
Route::get('f27fc78ffa140e97e0c535374a2a2213','CreatorController@saldo');
Route::get('f27fc78ffa140e97e0c535374a2a2213/tarik','CreatorController@saldotarik');
Route::post('data/bank','CreatorController@databank');
Route::post('data/penarikan','CreatorController@penarikan');
Route::post('/d2db4b7025da2358d8279ecca5ef6832', function(){
    return redirect()->route('transaksi');
})->name('donation.finish');

// Route::get('/', 'TransaksiController@index')->name('welcome');
Route::post('/transaksi/store', 'TransaksiController@submitDonation')->name('donation.store');
Route::post('/4760e8b83f2c2011f16f67c4d98b426d', 'TransaksiController@notificationHandler')->name('notification.handler');
Route::get('/{nama}','Controller@lihatkreatorbynama');
