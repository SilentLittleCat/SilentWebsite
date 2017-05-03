<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Code;
use App\User;
use DB, Storage, Debugbar;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $info = array('user' => User::find($id));
        $codes = Code::where('user_id', $id)->paginate(Code::$code_of_each_page);

        if($codes->count() == 0)
        {
            $codes = Code::where('user_id', $id)->paginate(Code::$code_of_each_page, ['*'], 'page', $codes->lastPage());
        }

        $info = array_merge(array('codes' => $codes), $info);

        if($request->has('style') && in_array($request->input('style'), Code::$display_styles))
        {
            $info = array_merge(array('style' => $request->input('style')), $info);
        }
        else
        {
            $info = array_merge(array('style' => Code::$default_display_style), $info);
        }

        return view('frontend.codes.index', $info);

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $info = User::getUserInfo($id);
        if($info['is_admin'])
        {
            return view('frontend.codes.create', $info);
        }
        else
        {
            return redirect('/u/' . $id . '/codes');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $code_id)
    {
        $code = new Code;
        $code->header = $request->header;
        $code->categories = $request->categories;
        $code->description = $request->description;
        $path = Code::$code_content_path . time() . str_random(8) . '.txt';
        if(Storage::put($path, $request->content))
        {
            $code->content_path = $path;
        }
        if(!$code->saveOrFail())
        {
            return back()->withInput();
        }
        $code_id = $code->id;
        DB::transaction(function() use($id, $code_id){
            DB::table('code_user')->insert([
                'user_id' => $id,
                'code_id' => $code_id
            ]);
        });
        return redirect()->route('codes.show', ['id' => $id, 'code_id' => $code_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $code_id)
    {
        $info = User::getUserInfo($id);
        $code = Code::where('id', $code_id)->first();
        $code->content = Storage::get($code->content_path);
        $info = array_merge(array('code' => $code), $info);

        return view('frontend.codes.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = User::getUserInfo($id);
        $code = Code::where('id', $code_id)->get();
        $code->content = Storage::get($code->content_path);
        $info = array_merge(array('code' => $code), $info);
        return view('frontend.codes.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $code_id)
    {
        $code = Code::find($code_id);
        $code->header = $request->header;
        $code->categories = $request->categories;
        $code->description = $request->description;
        if(Storage::exists('public' . substr($code->content_path, 7)))
        {
            Storage::delete('public' . substr($code->content_path, 7));
        }
        $path = Code::$code_content_path . time() . str_random(8) . '.txt';
        if(Storage::put($path, $request->content))
        {
            $code->content_path = $path;
        }
        if(!$code->saveOrFail())
        {
            return back()->withInput();
        }
        $code_id = $code->id;
        DB::transaction(function() use($id, $code_id){
            DB::table('code_user')->insert([
                'user_id' => $id,
                'code_id' => $code_id
            ]);
        });
        return redirect()->route('codes.show', ['id' => $id, 'code_id' => $code_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $code_id)
    {
        $code = Code::where('id', $code_id)->first();
        if(!is_null($code->content_path) && Storage::exists('public' . substr($code->content_path, 7)))
        {
            Storage::delete('public' . substr($code->content_path, 7));
        }

        DB::transaction(function() use($code_id) {
            code::where('id', $code_id)->delete();
            DB::table('code_user')->where('code_id', $code_id)->delete();
        });

        return back();
    }
}
