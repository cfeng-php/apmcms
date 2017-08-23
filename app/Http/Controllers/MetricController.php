<?php

namespace App\Http\Controllers;

use App\Model\MetricService;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class MetricController extends BaseController
{
    public function service(Request $request)
    {
        $page_num = 10;
        $services = DB::table('metric_service')->orderBy('integration','asc');
        $search_name = null;
        if($request->has('search_name')){
            $search_name = $request->search_name;
            $services = $services->where('integration','like','%'.$search_name.'%');
        }
        $services = $services->paginate($page_num);
        return view('backend.service.service',['datas' => $services,'page_num' => $page_num,'search_name' => $search_name]);
    }

    public function show(Request $request,$integration)
    {
        $data = DB::table('metric_service')->where('integration',$integration)->first();

        return view('backend.service.show',['data' => $data]);
    }

    public function update(Request $request,$integration)
    {
        //var_dump($request->all());exit();
        $data = [
            'integration' => $request->integration,
            'type' => $request->type,
            'typedesc' => getMetricServiceTypeName($request->type),
            'is_display' => $request->is_display,
            'alias' => $request->alias,
            'logo' => $request->logo,
            'logoname' => $request->logoname,
        ];

        //是否有上传文件
        if ($request->hasFile('mpicurl') && $request->file('mpicurl')->isValid()) {
            $path = public_path() . '/images';
            $filename = uniqid().'.png';
            $file = $request->mpicurl->move($path, $filename);
            $image_info = getimagesize($file);
            $image_data = file_get_contents($file);
            $mpicurl = 'data:' . $image_info['mime'] . ';base64,' . base64_encode($image_data);
            $data['mpicurl'] = $mpicurl;
            unlink($file);
        }

        if($request->has('action') && $request->action == 'add'){
            $data['id'] = md5($integration);
            DB::table('metric_service')->insert($data);
        }else{
            DB::table('metric_service')->where('integration',$integration)->update($data);
        }
        return redirect('service/show/'.$request->integration);
    }

    public function add(Request $request)
    {
        return view('backend.service.add');
    }

    public function del(Request $request,$integration)
    {
        DB::table('metric_service')->where('integration',$integration)->delete();
        return redirect('service');
    }

    /**
     * 以下为服务指标控制器
     */
    public function metricList(Request $request)
    {
        $page_num = 10;
        $services = DB::table('metric_dis')->orderBy('metric_name','asc');
        $search_name = null;
        if($request->has('search_name')){
            $search_name = $request->search_name;
            $services = $services->where('metric_name','like','%'.$search_name.'%');
        }
        $services = $services->paginate($page_num);
        return view('backend.service.metric',['datas' => $services,'page_num' => $page_num,'search_name' => $search_name]);
    }

    public function metricShow(Request $request,$metric_name)
    {
        $data = DB::table('metric_dis')->where('metric_name',$metric_name)->first();
        return view('backend.service.metric_show',['data' => $data]);
    }

    public function metricUpdate(Request $request)
    {
        $arr = explode('.',$request->metric_name);
        if(count($arr) < 2){
            return back()->withInput()->withErrors('指标名不合格');
        }
        $data = [
            'integrationid' => $arr[0],
            'metric_name' => $request->metric_name,
            'subname' => $request->subname,
            'metric_type' => $request->metric_type,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'metric_alias' => $request->metric_alias,
        ];
        if($request->plural_unit != 'null') $data['plural_unit'] = $request->plural_unit;
        if($request->per_unit != 'null') $data['per_unit'] = $request->per_unit;

        if($request->has('action') && $request->action == 'add'){
            $data['updatetime'] = date("Y-m-d H:i:s");
            $data['createtime'] = date("Y-m-d H:i:s");
            DB::table('metric_dis')->insert($data);
            $data = DB::table('metric_service')->where('integration',$arr[0])->first();
            if(!$data){
                DB::table('metric_service')->insert(['id' => strtoupper(md5(uniqid())),'integration' => $arr[0]]);
            }
        }else{
            $data['updatetime'] = date("Y-m-d H:i:s");
            DB::table('metric_dis')->where('metric_name',$request->metric_name)->update($data);
        }

        return redirect('service/metric/show/'.$request->metric_name);
    }

    public function metricAdd()
    {
        return view('backend.service.metric_add');
    }

    public function metricDel(Request $request,$metric_name)
    {
        DB::table('metric_dis')->where('metric_name',$metric_name)->delete();
        return redirect('service/metric');
    }

    /**
     * 已安装服务列表
     */
    public function installedList(Request $request)
    {
        $page_num = 10;
        $services = DB::table('apmservices')->orderBy('integration','asc');
        $search_name = null;
        if($request->has('search_name')){
            $search_name = $request->search_name;
            $services = $services->where('integration','like','%'.$search_name.'%');
        }
        $services = $services->paginate($page_num);
        return view('backend.service.installed',['datas' => $services,'page_num' => $page_num,'search_name' => $search_name]);
    }

    public function installedShow(Request $request,$integration)
    {
        $data = DB::table('apmservices')->where('integration',$integration)->first();
        return view('backend.service.installed_show',['data' => $data]);
    }
    public function installedEdit(Request $request,$integration)
    {
        $services = DB::table('metric_service')->orderBy('integration','asc')->select('integration')->get();
        $data = DB::table('apmservices')->where('integration',$integration)->first();
        return view('backend.service.installed_edit',['data' => $data,'services' => $services]);
    }

    public function installedUpdate(Request $request)
    {
        if(!$request->has('integration')){
            return back()->withInput()->withErrors('服务名称缺失');
        }
        $data = [
            'integration' => $request->integration,
            'updatetime' => date('Y-m-d H:i:s'),
            'description' => $request->description,
            'setup' => $request->setup
        ];
        if($request->has('action') && $request->action == 'add'){
            $data['publishtime'] = date('Y-m-d H:i:s');
            $data['mid'] = md5($request->integration);
            $data['id'] = time().rand(1111,9999);
            DB::table('apmservices')->insert($data);
        }else{
            DB::table('apmservices')->where('integration',$request->integration)->update($data);
        }

        return redirect('service/installed/show/'.$request->integration);
    }

    public function installedAdd(Request $request)
    {
        $services = DB::table('metric_service')->orderBy('integration','asc')->select('integration')->get();
        return view('backend.service.installed_add',['services' => $services]);
    }

    public function installedDel(Request $request,$integration)
    {
        DB::table('apmservices')->where('integration',$integration)->delete();
        return redirect('service/installed');
    }













}
