<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddUserRequest;
use File;


class HomeController extends Controller
{
        public function __construct()
    {
       // $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function addUser(StoreAddUserRequest $request) {
        $f_name = $request->input('f_name');
        $email = $request->input('email');
        $l_name = $request->input('l_name');
        $keywords = $request->input('keywords');
        $password = md5($request->input('password'));
        $file = $request->file('fileToUpload');
        $filename=$file->getClientOriginalName();
        $array = explode(".",$filename);
        $format = end($array);
        $date=date('Y_m_d_H_i_s');
        $file_name='resume_'.$f_name.'_'.$l_name.'_'.$date.'.'.$format; 
        $move=move_uploaded_file($file,'uploads/'.$file_name);
        $id=User::insertGetId(
                ['f_name' => $f_name, 'email'=>$email, 'l_name' => $l_name,'keywords' => $keywords, 'password'=>$password, 'resume' => $file_name]
        );
        if($move && $id){
            session(['id' => $id]);
            return redirect()->action('HomeController@logUser');
        }else{
            $msg='Something went wrong,please try again';
            return redirect()->back()->with('msg',$msg);
        }
    }
    public function search(Request $request) {
        $f_name = $request->input('search_fname');
        $l_name = $request->input('search_lname');
        $keywords = $request->input('search_keywords');
        $users = User::where('f_name','like','%'.$f_name.'%')
                        ->where('l_name','like','%'.$l_name.'%')
                        ->where('keywords','like','%'.$keywords.'%')
                        ->paginate(3);
        $id = session('id');
        $users->id=$id;
        $users->setPath('search?search_fname='.$f_name.'&search_lname='.$l_name.'&search_keywords='.$keywords);
        return view('logUser')->with('users',$users);
        exit();
    }
    public function LogUser(Request $request) {
        $id = session('id');
        $users = User::paginate(3);
        $users->id=$id;
        return view('logUser')->with('users',$users);
    }
    public function login(Request $request) {
        $email = $request->input('email');
        $password = md5($request->input('password'));
        $user=User::where('password',$password)
                    ->where('email',$email)
                    ->get();
        if(empty($user[0])){
            $msg='Incorrect Login or Password';
            return redirect()->back()->with('msg',$msg); 
        }else{
            $id=$user[0]['id'];
            session(['id' => $id]);
            return redirect()->action('HomeController@logUser');
        }
    }
    public function logout(Request $request) {
        $request->session()->forget('id');
        return redirect()->action('HomeController@index');
    }
    public function deleteUser(Request $request) {
        $id = $request->input('id');
        $info=User::where('id',$id)
                    ->get();
        $del_file=File::delete('uploads/'.$info[0]['resume']);
        $del=User::where('id',$id)
                   ->delete();
        if($del && $del_file){
            echo 1;
            exit();
        }
    }
    public function getDownload(Request $request) {
        $file_name = $request->input('file_name');
        $file= 'uploads/'.$file_name;
        return response()->download($file, $file_name);
    }
}
