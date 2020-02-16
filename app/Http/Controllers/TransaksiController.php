<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\transaksi;
use Veritrans_Config;
use App\User;
use Veritrans_Snap;
use Veritrans_Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Notifications\dukungan;
use App\Notifications\pendukung;
use App\follower;


class TransaksiController extends Controller
{
  use Notifiable;

    /**
     * Make request global.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        // $this->middleware(['auth','verified']);

        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Show index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['donations'] = transaksi::orderBy('id', 'desc')->paginate(8);

        return view('transaksi', $data);
    }

    /**
     * Submit donation.
     *
     * @return array
     */
    public function submitDonation()
    {
        \DB::transaction(function(){
        $idd=$this->request->now.Auth::user()->id.$this->request->idpaket.$this->request->idkreator;

            // Save donasi ke database
            $transaksi = transaksi::create([
                'kode' => $idd,
                'ID_USER' => Auth::user()->id,
                'ID_PAKET' => $this->request->idpaket,
                'ID_CREATOR' => $this->request->idkreator,
                'harga' => str_replace(".","",$this->request->harga)
            ]);
            $paket = DB::table('paket')->where('id', '=',$this->request->idpaket)->get();
            foreach ($paket as $ke) {
                $payload = [
                    'transaction_details' => [
                        'order_id'      => $transaksi->kode,
                        'gross_amount'  => intval(str_replace(".","", $transaksi->harga)),
                    ],
                    'customer_details' => [
                        'first_name'    => Auth::user()->name,
                        'email'         => Auth::user()->email,
                        // 'phone'         => '08888888888',
                        // 'address'       => '',
                    ],
                    'item_details' => [
                        [
                            'id'       => $ke->id,
                            'price'    => intval(str_replace(".","", $ke->harga)),
                            'name'     => $ke->nama_paket,
                            'quantity'     => 1,
                            'keterangan'     => 1,
                        ]
                    ]
                        ];
            }
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $transaksi->snap_token = $snapToken;
            $transaksi->save();

            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
    }

    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     *
     * @return void
     */
    public function notificationHandler(Request $request)
    {
//       $Data = $request->Data;
// dd($request->request->getParameters());
      

      $notif = new Veritrans_Notification();
         \DB::transaction(function() use($notif) {
          $transaction = $notif->transaction_status;
          $type = $notif->payment_type;
          $orderId = $notif->order_id;
          $fraud = $notif->fraud_status;
          $transaksi = DB::table('transaksis')->where('kode', '=',$orderId)->first();
          $donation = transaksi::where('kode', '=', $orderId)->firstOrFail();

          //ambildata
          $usera = DB::table('users')->where('id', '=',$transaksi->ID_USER)->first();
          $creatora = DB::table('creators')->where('id', '=',$transaksi->ID_CREATOR)->first();
          $creator = DB::table('users')->where('id', '=',$creatora->ID_USER)->first();
          $paket = DB::table('paket')->where('id', '=',$transaksi->ID_PAKET)->first();
// dd();
         

           if ($transaction == 'capture') {

             // For credit card transaction, we need to check whether transaction is challenge by FDS or not
             if ($type == 'credit_card') {

               if($fraud == 'challenge') {
                 // TODO set payment status in merchant's database to 'Challenge by FDS'
                 // TODO merchant should decide whether this transaction is authorized or not in MAP
                 // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                 $donation->setPending();
               } else {  //member
                $date = date("Y-m-d");
                $date1 = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
                $date2 = date("Y-m-d",$date1);
                DB::table('memberships')->insert([[
                  'id_creator' => $transaksi->ID_CREATOR, 
                  'id_user' => $transaksi->ID_USER,  
                  'paket' => $transaksi->ID_PAKET, 
                  'tenggatwaktu' => $date2, 
                  'status' => 1, 
                  'created_at' => $date,
                ]]);

                
  $user = DB::table('followers')->where('id_user', $transaksi->ID_USER)->first();

  if ($user == null) {
              DB::table('followers')->insert([
                [
                   'id_user' => $transaksi->ID_USER,
                   'id_following' => $transaksi->ID_CREATOR,
                ]
              ]);
  }else{
    $id_followcreator = "";
        $id_followcreators = "";
        $following = follower::where('id_user', $usera->id)->get();
           if ($following !== "") {
        // dd($following);

            # code...
            foreach ($following as $followings) {
            $id_followcreators = $followings->id_following;
            $id_followcreator = explode(",", $id_followcreators);
        }
        if (in_array($transaksi->ID_CREATOR, $id_followcreator)) {

        }else{
          $idfollow;
          $follow = DB::table('followers')->where('id_user', $transaksi->ID_USER)->get();
          foreach ($follow as $follows) {
              $idfollow = $follows->id_following;
          }
          if ($idfollow === "") {
              DB::table('followers')->where('id_user',$transaksi->ID_USER)->update([
  
                  'id_user' =>  $transaksi->ID_USER,
                  'id_following' => $transaksi->ID_CREATOR,
                  ]);
          }else{
              DB::table('followers')->where('id_user',$transaksi->ID_USER)->update([
  
                  'id_user' =>  $transaksi->ID_USER,
                  'id_following' => $idfollow.','.$transaksi->ID_CREATOR,
                  ]);
  
          }
          }}
          
  }
                DB::table('creators')->where('id',$transaksi->ID_CREATOR)->increment('followers');
                DB::table('creators')->where('id',$transaksi->ID_CREATOR)->update([
                  'saldo' =>  $transaksi->harga,
                  ]);
                 // TODO set payment status in merchant's database to 'Success'
                 // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                 $donation->setSuccess();

        //send notif
        $username = $usera->name;
        $useremail = $usera->email;
        $creatorname = $creator->name;
        $creatoremail = $creator->email;
        $paket = $paket->nama_paket;
        $total = $transaksi->harga;
        $data = [ 
          'username' => $username,
          'creatorname' => $creator->name,
          'paket' =>  $paket,
          'total' => $transaksi->harga
         ];

        $user = new User();
        $user->email = $creatoremail;   // This is the email you want to send to.
        $user->notify(new dukungan($data));
        $user->email = $useremail;   // This is the email you want to send to.
        $user->notify(new pendukung($data));
               }

             }

           } elseif ($transaction == 'settlement') {
  //member
      $date = date("Y-m-d");
      $date1 = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
      $date2 = date("Y-m-d",$date1);

  $membership = DB::table('memberships')->where('id_user', $transaksi->ID_USER)->first();
  if (isset($membership)) {
    DB::table('memberships')->where('id', 1)
    ->update([
      'id_creator' => $transaksi->ID_CREATOR, 
      'id_user' => $transaksi->ID_USER,  
      'paket' => $transaksi->ID_PAKET, 
      'tenggatwaktu' => $date2, 
      'status' => 1, 
      'updated_at' => $date,
    ]);
}else{
  DB::table('memberships')->insert([[
    'id_creator' => $transaksi->ID_CREATOR, 
    'id_user' => $transaksi->ID_USER,  
    'paket' => $transaksi->ID_PAKET, 
    'tenggatwaktu' => $date2, 
    'status' => 1, 
    'created_at' => $date,
  ]]);
}

  $user = DB::table('followers')->where('id_user', $transaksi->ID_USER)->first();

  if ($user == null) {
              DB::table('followers')->insert([
                [
                   'id_user' => $transaksi->ID_USER,
                   'id_following' => $transaksi->ID_CREATOR,
                ]
              ]);
  }else{
    $id_followcreator = "";
        $id_followcreators = "";
        $following = follower::where('id_user', $usera->id)->get();
           if ($following !== "") {
        // dd($following);

            # code...
            foreach ($following as $followings) {
            $id_followcreators = $followings->id_following;
            $id_followcreator = explode(",", $id_followcreators);
        }
        if (in_array($transaksi->ID_CREATOR, $id_followcreator)) {

        }else{
          $idfollow;
          $follow = DB::table('followers')->where('id_user', $transaksi->ID_USER)->get();
          foreach ($follow as $follows) {
              $idfollow = $follows->id_following;
          }
          if ($idfollow === "") {
              DB::table('followers')->where('id_user',$transaksi->ID_USER)->update([
  
                  'id_user' =>  $transaksi->ID_USER,
                  'id_following' => $transaksi->ID_CREATOR,
                  ]);
          }else{
              DB::table('followers')->where('id_user',$transaksi->ID_USER)->update([
  
                  'id_user' =>  $transaksi->ID_USER,
                  'id_following' => $idfollow.','.$transaksi->ID_CREATOR,
                  ]);
  
          }
          }}
          
  }
  DB::table('creators')->where('id',$transaksi->ID_CREATOR)->increment('followers');
  // dd(str_replace(".","", $transaksi->harga));
  DB::table('creators')->where('id',$transaksi->ID_CREATOR)->update([
    'saldo' =>  $transaksi->harga,
    ]);
             // TODO set payment status in merchant's database to 'Settlement'
             // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
             $donation->setSuccess();
        

        //send notif
        $username = $usera->name;
        $useremail = $usera->email;
        $creatorname = $creator->name;
        $creatoremail = $creator->email;
        $paket = $paket->nama_paket;
        $total = $transaksi->harga;
        $data = [ 
          'username' => $username,
          'creatorname' => $creator->name,
          'paket' =>  $paket,
          'total' => $transaksi->harga
         ];

        $user = new User();
        $user->email = $creatoremail;   // This is the email you want to send to.
        $user->notify(new dukungan($data));
        $user->email = $useremail;   // This is the email you want to send to.
        $user->notify(new pendukung($data));
           } elseif($transaction == 'pending'){

             // TODO set payment status in merchant's database to 'Pending'
             // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
             $donation->setPending();

           } elseif ($transaction == 'deny') {

             // TODO set payment status in merchant's database to 'Failed'
             // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
             $donation->setFailed();

           } elseif ($transaction == 'expire') {

             // TODO set payment status in merchant's database to 'expire'
             // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
             $donation->setExpired();

           } elseif ($transaction == 'cancel') {

             // TODO set payment status in merchant's database to 'Failed'
             // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
             $donation->setFailed();

           }

         });


        return;
    }
}
