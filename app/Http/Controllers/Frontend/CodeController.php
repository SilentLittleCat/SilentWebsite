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
        $codes = Code::where('user_id', $id)->paginate(Code::$codes_of_each_page);

        if($codes->count() == 0)
        {
            $codes = Code::where('user_id', $id)->paginate(Code::$codes_of_each_page, ['*'], 'page', $codes->lastPage());
        }

        $allCodes = Code::where('user_id', $id)->get();
        $categories = $allCodes->map(function($item, $key) {
            return explode(",", $item->categories);
        })->flatten()->toArray();
        $categories = array_count_values($categories);
        arsort($categories);

        $reading_ranks = $allCodes->map(function($item, $key) {
            return [
                'id' => $item->id,
                'header' => $item->header,
                'reading_times' => $item->reading_times
            ];
        })->take(Code::$number_of_reading_ranks)->sortByDesc(function($item, $key) {
            return $item['reading_times'];
        });

        $info = array_merge(array('codes' => $codes), $info);
        $info = array_merge(array('categories' => $categories), $info);
        $info = array_merge(array('reading_ranks' => $reading_ranks), $info);

        if($request->has('style') && in_array($request->input('style'), Code::$display_styles))
        {
            $info = array_merge(array('style' => $request->input('style')), $info);
        }
        else
        {
            $info = array_merge(array('style' => Code::$default_display_style), $info);
        }

        return view('frontend.codes.index', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Auth::user()->id == $id)
        {
            return view('frontend.codes.create', [
                'user' => User::find($id)
            ]);
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
        $code->user_id = $id;
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

        return redirect()->route('codes.show', ['id' => $id, 'code_id' => $code->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $code_id)
    {
        $code = Code::where('id', $code_id)->first();
        $code->content = Storage::get('public' . substr($code->content_path, 7));

        return view('frontend.codes.show', [
            'user' => User::find($id),
            'code' => $code
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('frontend.codes.edit', [
            'user' => User::find($id),
            'code' => Code::where('id', $code_id)->first()
        ]);
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

        return redirect()->route('codes.show', ['id' => $id, 'code_id' => $code->id]);
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

        $code->delete();

        return redirect()->route('codes.index', ['id' => $id]);
    }

    public function searchCode(Request $request, $id)
    {
        if(!$request->has('key'))
        {
            return response()->json(array(), 200);
        }
        
        $codes = Code::select(['header', 'description'])->where('user_id', $id)->where('header', 'like', '%' . $request->key . '%')->get();

        foreach($codes as $code)
        {
            $code->url = route('codes.show', ['id' => $id, 'code_id' => $code->id]);
        }

        return response()->json(array('items' => $codes), 200);
    }
}
