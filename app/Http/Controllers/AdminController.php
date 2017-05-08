<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use Validator;
use App\Http\Requests;

class AdminController extends BaseController
{
    private function adminValidator($request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:admins,id,'.$request->segment(3),
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
            if(isset($errors['email'])){
                $message = '邮箱格式不合格或邮箱已存在';
            }else{
                $message = '表单数据填写不合格，请重试';
            }
        }else{
            $message = '';
        }
        return $message;
    }
    public function index()
    {
        $page_num = 10;
        $admins = Admin::orderBy('active','desc')->orderBy('updated_at','desc')->paginate($page_num);
        return view('backend.admin.list',['admins' => $admins,'page_num' => $page_num]);
    }

    public function add()
    {
        return view('backend.admin.add');
    }

    public function store(Request $request)
    {
        $message = $this->adminValidator($request);
        if($message){
            return back()->withInput()->withErrors($message);
        }
        $admin = new Admin();
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->password = Hash::make(123456);
        $admin->active = 1;
        $admin->save();
        return redirect('admin/list');
    }

    public function edit(Request $request,$id)
    {
        $admin = Admin::find($id);
        return view('backend.admin.edit',['datas' => $admin]);
    }

    public function update(Request $request,$id)
    {
        $message = $this->adminValidator($request);
        if($message){
            return back()->withInput()->withErrors($message);
        }
        $admin = Admin::find($id);
        if($admin){
            $admin->email = $request->email;
            $admin->name = $request->name;
            $admin->save();
        }else{
            Auth::logout();
        }
        return redirect('admin/list');
    }

    public function active(Request $request,$id)
    {
        $admin = Admin::find($id);
        if($admin){
            if($admin->active){
                $admin->active = 0;
            }else{
                $admin->active = 1;
            }
            $admin->save();
        }else{
            Auth::logout();
        }
        return redirect('admin/list');
    }

    public function changePwd(Request $request,$id)
    {
        $admin = Admin::find($id);
        if(!$admin) Auth::logout();
        if($request->has('action') && $request->action == 'change_pwd'){
            $validator = Validator::make($request->all(), [
                'old_pwd' => 'required|min:6|alpha_dash',
                'new_pwd' => 'required|min:6|alpha_dash',
                're_new_pwd' => 'required|min:6|alpha_dash',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->getMessages();
                if(isset($errors['old_pwd'])){
                    $message = '旧密码输入不合格';
                }else if(isset($errors['new_pwd']) || isset($errors['re_new_pwd'])){
                    $message = '新密码输入不合格';
                }else{
                    $message = '密码不合格';
                }
                return back()->withInput()->withErrors($message);
            }
            $old_pwd = $request->old_pwd;
            $new_pwd = $request->new_pwd;
            $re_new_pwd = $request->re_new_pwd;
            if(!Hash::check($old_pwd, $admin->password)){
                return back()->withInput()->withErrors('原密码错误');
            }
            if($new_pwd !== $re_new_pwd){
                return back()->withInput()->withErrors('两次密码不一致，请重试');
            }
            $admin->password = Hash::make($new_pwd);
            $admin->save();
            Auth::logout();
            return redirect('login');
        }
        return view('backend.admin.change',['datas' => $admin]);
    }

}