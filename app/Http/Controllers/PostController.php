<?php
namespace App\Http\Controllers;
use Validator;
use App\creator;
use App\file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\post;
use Alert;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    protected $except = ['image/upload/store', ];

    public function hapus(Request $request)
    {
        //
        DB::table('posts')->where('id', '=', $request->id)->delete();
    }
    public function tulis(Request $request)
    {


        $date = now();
        $Data = $request->Data;
        $name = [];
        $id_creator;
        $tumbnail = "";
        $creator = creator::where('ID_USER', Auth::user()->id)->get();
        foreach ($creator as $creators)
        {
            $id_creator = $creators->id;
        }
        $uploaded = $request->thumbnail;
        if ($uploaded === "undefined")
        {
        }
        else
        {
            $file_parts = pathinfo($uploaded);


                $tumbnail = "tb" . time() . Auth::user()->id . $uploaded->getClientOriginalName();

                $ext = pathinfo($tumbnail, PATHINFO_EXTENSION);
                if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                $uploaded->move(storage_path('/app/public/file') , $tumbnail);
                }else{
                    return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


                }

        }

        $image = $request->file('file');
        if (is_null($image))
        {
            DB::table('posts')->insert([['ID_CREATOR' => $id_creator, 'title' => $request->title, 'caption' => $request->caption, 'desc' => $request->desc, 'privilage' => $request->privilage, 'tipe' => 1, 'thumbnail' => $tumbnail, 'created_at' => $date

            ]]);
        }
        else
        {
            if (is_array($image))
            {
                foreach ($image as $item)
                {
                    $imageId = time() . Auth::user()->id . $item->getClientOriginalName();
                    $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                    if ($ext == "pdf" ) {
                        $imageName = $item->getClientOriginalName();
                    $item->move(storage_path('/app/public/file') , $imageId);
                    $name['ori'][] = $imageName;
                    $name['palsu'][] = $imageId;
                        }else{
                            return response(['data'=>"file gambar harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


                        }

                }
            }
            else
            {

                $imageId = time() . Auth::user()->id . $image->getClientOriginalName();
                $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                if ($ext == "pdf") {
                    $imageName = $image->getClientOriginalName();
                $image->move(storage_path('/app/public/file') , $imageId);
                $name['ori'][] = $imageName;
                $name['palsu'][] = $imageId;
                    }else{
                        return response(['data'=>"file video harus berupa .mp4",'tipe'=>"danger"], 404);
                    }
            }

            $name['ori'] = implode(",", $name['ori']);
            $name['palsu'] = implode(",", $name['palsu']);

            // dd($creator);
            DB::table('posts')->insert([['ID_CREATOR' => $id_creator, 'caption' => $request->get('caption') , 'title' => $request->get('title') , 'desc' => $request->get('desc') , 'file_name' => $name['ori'], 'file' => $name['palsu'], 'thumbnail' => $tumbnail, 'tipe' => 1, 'privilage' => $request->get('privilage'), 'created_at' => $date

            ]]);
        }
        return response()->json($name);

    }

    public function gambar(Request $request)
    {
        $date = now();

        $name = [];
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)
            ->get();
        foreach ($creator as $creators)
        {
            $id_creator = $creators->id;
        }
        // dd($request->all());
        $uploaded = $request->thumbnail;
        if ($uploaded === "undefined")
        {
            return response(['data'=>"thumbnail tidak boleh kosong",'tipe'=>"danger"], 404);

        }
        else
        {
            $file_parts = pathinfo($uploaded);


                $tumbnail = "tb" . time() . Auth::user()->id . $uploaded->getClientOriginalName();

                $ext = pathinfo($tumbnail, PATHINFO_EXTENSION);
                    if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                        $uploaded->move(storage_path('/app/public/file') , $tumbnail);
                        }else{
                            return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


                        }


        }

        $image = $request->file('file');
        if (is_null($image))
        {
            return response(['data'=>"file gambar tidak boleh kosong",'tipe'=>"danger"], 404);


        }
        else
        {
            if (is_array($image))
            {
                foreach ($image as $item)
                {
                    $imageId = time() . Auth::user()->id . $item->getClientOriginalName();
                    $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                    if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                        $imageName = $item->getClientOriginalName();
                    $item->move(storage_path('/app/public/file') , $imageId);
                    $name['ori'][] = $imageName;
                    $name['palsu'][] = $imageId;
                        }else{
                            return response(['data'=>"file gambar harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


                        }

                }
            }
            else
            {

                $imageId = time() . Auth::user()->id . $image->getClientOriginalName();
                $ext = pathinfo($imageId, PATHINFO_EXTENSION);
                if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                $imageName = $item->getClientOriginalName();
                $image->move(storage_path('/app/public/file') , $imageId);
                $name['ori'][] = $imageName;
                $name['palsu'][] = $imageId;
            }else{
                return response(['data'=>"file gambar harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


            }
            }

            $name['ori'] = implode(",", $name['ori']);
            $name['palsu'] = implode(",", $name['palsu']);

            // dd($creator);
            DB::table('posts')->insert([
                ['ID_CREATOR' => $id_creator,
                'caption' => $request->get('caption') ,
                'title' => $request->get('title') ,
                'desc' => $request->get('desc') ,
                'file_name' => $name['ori'],
                'file' => $name['palsu'],
                'thumbnail' => $tumbnail,
                'tipe' => 2,
                'privilage' => $request->get('privilage'),
                'created_at' => $date

            ]]);
        }
        return response()->json($name);

    }

    public function video(Request $request)
    {
        $date = now();

        $name = [];
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)
            ->get();
        foreach ($creator as $creators)
        {
            $id_creator = $creators->id;
        }
        // dd($request->all());
        $uploaded = $request->thumbnail;
        if ($uploaded === "undefined")
        {
            return response(['data'=>"thumbnail tidak boleh kosong",'tipe'=>"danger"], 404);

        }
        else
        {
            $file_parts = pathinfo($uploaded);


                $tumbnail = "tb" . time() . Auth::user()->id . $uploaded->getClientOriginalName();

                $ext = pathinfo($tumbnail, PATHINFO_EXTENSION);
                    if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                        $uploaded->move(storage_path('/app/public/file') , $tumbnail);
                        }else{
                            return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


                        }


        }

        $image = $request->file('file');

        if (is_null($image))
        {
                return response(['data'=>"video tidak boleh kosong",'tipe'=>"danger"], 404);


        }
        else
        {
            if (is_array($image))
            {
                foreach ($image as $item)
                {


                    $imageId = time() . Auth::user()->id . $item->getClientOriginalName();
                    $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                    if ($ext == "mp4") {
                        $imageName = $item->getClientOriginalName();
                    $item->move(storage_path('/app/public/file') , $imageId);
                    $name['ori'][] = $imageName;
                    $name['palsu'][] = $imageId;
                        }else{
                            return response(['data'=>"file video harus berupa .mp4",'tipe'=>"danger"], 404);
                        }

                }
                foreach ($image as $item)
                {


                    $imageId = time() . Auth::user()->id . $item->getClientOriginalName();
                        $imageName = $item->getClientOriginalName();
                    $item->move(storage_path('/app/public/file') , $imageId);
                    $name['ori'][] = $imageName;
                    $name['palsu'][] = $imageId;

                }
            }
            else
            {

                $imageId = time() . Auth::user()->id . $image->getClientOriginalName();
                $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                if ($ext == "mp4") {
                    $imageName = $image->getClientOriginalName();
                $image->move(storage_path('/app/public/file') , $imageId);
                $name['ori'][] = $imageName;
                $name['palsu'][] = $imageId;
                    }else{
                        return response(['data'=>"file video harus berupa .mp4",'tipe'=>"danger"], 404);
                    }
            }

            $name['ori'] = implode(",", $name['ori']);
            $name['palsu'] = implode(",", $name['palsu']);

            // dd($creator);
            DB::table('posts')->insert([['ID_CREATOR' => $id_creator, 'title' => $request->get('title'), 'caption' => $request->get('caption') , 'desc' => $request->get('desc') , 'file_name' => $name['ori'], 'file' => $name['palsu'], 'thumbnail' => $tumbnail, 'tipe' => 3, 'privilage' =>$request->get('privilage'), 'created_at' => $date

            ]]);
        }

        return response()->json($name);

    }

    public function musik(Request $request)
    {
        $date = now();

        $name = [];
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)
            ->get();
        foreach ($creator as $creators)
        {
            $id_creator = $creators->id;
        }
        // dd($request->all());
        $uploaded = $request->thumbnail;
        if ($uploaded === "undefined")
        {
            return response(['data'=>"thumbnail tidak boleh kosong",'tipe'=>"danger"], 404);

        }
        else
        {
            $file_parts = pathinfo($uploaded);


                $tumbnail = "tb" . time() . Auth::user()->id . $uploaded->getClientOriginalName();

                $ext = pathinfo($tumbnail, PATHINFO_EXTENSION);
                    if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg" ) {
                        $uploaded->move(storage_path('/app/public/file') , $tumbnail);
                        }else{
                            return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);


                        }


        }

        $image = $request->file('file');
        if (is_null($image))
        {
            return response(['data'=>"file musik tidak boleh kosong",'tipe'=>"danger"], 404);

        }
        else
        {
            if (is_array($image))
            {
                foreach ($image as $item)
                {
                    $imageId = time() . Auth::user()->id . $item->getClientOriginalName();
                    $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                    if ($ext == "mp3") {
                        $imageName = $item->getClientOriginalName();
                    $item->move(storage_path('/app/public/file') , $imageId);
                    $name['ori'][] = $imageName;
                    $name['palsu'][] = $imageId;
                        }else{
                            return response(['data'=>"file musik harus berupa .mp3",'tipe'=>"danger"], 404);
                        }
                }
            }
            else
            {

                $imageId = time() . Auth::user()->id . $image->getClientOriginalName();
                $ext = pathinfo($imageId, PATHINFO_EXTENSION);

                if ($ext == "mp3") {
                    $imageName = $image->getClientOriginalName();
                $image->move(storage_path('/app/public/file') , $imageId);
                $name['ori'][] = $imageName;
                $name['palsu'][] = $imageId;
                    }else{
                        return response(['data'=>"file musik harus berupa .mp3",'tipe'=>"danger"], 404);
                    }
            }

            $name['ori'] = implode(",", $name['ori']);
            $name['palsu'] = implode(",", $name['palsu']);

            // dd($creator);
            DB::table('posts')->insert([['ID_CREATOR' => $id_creator, 'title' => $request->get('title')  , 'caption' => $request->get('caption') , 'desc' => $request->get('desc') , 'file_name' => $name['ori'], 'file' => $name['palsu'], 'thumbnail' => $tumbnail, 'tipe' => 4, 'privilage' => $request->get('privilage'), 'created_at' => $date

            ]]);
        }
        return response()->json($name);

    }
    public function link(Request $request)
    {
        $date = now();

        $Data = $request->Data;
        $name = [];
        $id_creator;
        $creator = creator::where('ID_USER', Auth::user()->id)
            ->get();
        foreach ($creator as $creators)
        {
            $id_creator = $creators->id;
        }

        $image = $request->file('file');
        if (is_null($image))
        {
            DB::table('posts')->insert([['ID_CREATOR' => $id_creator, 'caption' => $Data['caption'], 'title' => $Data['title'], 'link' => $Data['url'], 'desc' => $Data['desc'], 'tipe' => 5, 'created_at' => $date,

            'privilage' => 1, ]]);
        }
        else
        {
            if (is_array($image))
            {
                foreach ($image as $item)
                {

                    $imageId = time() . Auth::user()->id . $item->getClientOriginalName();
                    $imageName = $item->getClientOriginalName();
                    $item->move(storage_path('/app/public/file') , $imageId);
                    $name['ori'][] = $imageName;
                    $name['palsu'][] = $imageId;
                }
            }
            else
            {
                $imageName = time() . Auth::user()->id . $item->getClientOriginalName();
                $image->move(storage_path('/app/public/file') , $imageName);
                $name[] = $imageName;
            }

            $name['ori'] = implode(",", $name['ori']);
            $name['palsu'] = implode(",", $name['palsu']);

            // dd($creator);
            DB::table('posts')->insert([['ID_CREATOR' => $id_creator, 'title' => $request->get('title') , 'desc' => $request->get('desc') , 'link' => $request->get('url') , 'file_name' => $name['ori'], 'file' => $name['palsu'], 'tipe' => 5, 'privilage' => 1, 'created_at' => $date

            ]]);
        }

        return response()->json($name);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $Data = $request->Data;

        dd($Data['desc']);
        return $this->fileStore($request);

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
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
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
