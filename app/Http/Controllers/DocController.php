<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class DocController extends BaseController
{

    public function typeList(Request $request)
    {
        $page_num = 10;
        $services = DB::table('doctype')->orderBy('id','desc')->paginate($page_num);
        return view('backend.document.type',['datas' => $services,'page_num' => $page_num]);
    }

    public function typeEdit(Request $request,$id)
    {
        if($request->has('type_name')){
            DB::table('doctype')->where('id',$id)->update(['type_name' => $request->type_name]);
        }
        return redirect('doc/type');
    }

    public function typeAdd(Request $request)
    {
        if($request->has('type_name')){
            DB::table('doctype')->insert(['type_name' => $request->type_name]);
        }
        return redirect('doc/type');
    }

    public function typeDel(Request $request,$id)
    {
        DB::table('doctype')->where('id',$id)->delete();
        return redirect('doc/type');
    }

    /**
     * 文档文本
     */
    public function textList(Request $request)
    {
        $search_type = null;
        $search_title = null;
        $page_num = 10;
        $services = DB::table('doctext')->leftJoin('doctype', 'doctype.id', '=', 'doctext.type')->orderBy('id','desc');
        if($request->has('search_type')){
            $search_type = $request->search_type;
            $services = $services->where('doctext.type',$search_type);
        }
        if($request->has('search_title')){
            $search_title = $request->search_title;
            $services = $services->where('doctext.title','like','%'.$search_title.'%');
        }
        $services = $services->select('doctext.*','doctype.type_name')->paginate($page_num);
        $types = DB::table('doctype')->orderBy('id','desc')->get();
        return view('backend.document.text',
                    ['datas' => $services,'types' => $types, 'page_num' => $page_num,
                        'search_type' => $search_type,'search_title' => $search_title
                    ]);
    }

    public function textAdd()
    {
        $types = DB::table('doctype')->orderBy('id','desc')->get();
        return view('backend.document.text_add',['types' => $types]);
    }

    public function textEdit($id)
    {
        $types = DB::table('doctype')->orderBy('id','desc')->get();
        $data = DB::table('doctext')->where('id',$id)->first();
        return view('backend.document.text_edit',['types' => $types,'data' => $data]);
    }

    public function textStore(Request $request)
    {
        $data = [
            'type' => $request->type,
            'title' => $request->title,
            'text' => $request->text
        ];
        if($request->has('action')){
            if($request->action == 'add'){
                $id =  DB::table('doctext')->insertGetId($data);
            }
            if($request->action == 'edit' && $request->has('id')){
                $id = $request->id;
                DB::table('doctext')->where('id',$id)->update($data);
            }

            return redirect('doc/text/edit/'.$id);
        }
        return redirect('doc/text');
    }

    public function textDel($id)
    {
        DB::table('doctext')->where('id',$id)->delete();
        return redirect('doc/text');
    }

    public function upload(Request $request)
    {
        $image = '';
        if ($request->hasFile('ajaxTextImageFile') && $request->file('ajaxTextImageFile')->isValid()) {
            $path = public_path() . '/images';
            $filename = uniqid().'.jpg';
            $file = $request->ajaxTextImageFile->move($path, $filename);
           $image =  url('/images/'.$filename);
        }
        return response()->json(['data'=>$image]);
    }
}
