<?php

namespace App\Http\Controllers\front\workerProfile;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\WorkerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index(){
        return view('front.profil.index');
    }

    public function update(Request $request) {
        $all = $request->except('_token');
        if($all['password']==""){
            unset($all['password']);
        }
        else
        {
            $all['password'] = md5($all['password']);
            Worker::where('id', Auth::id())->update(['password' => $all['password']]);
        }
        $data = Worker::where('id',Auth::id())->get();
        $all['photo'] = fileUpload::changeUpload($data['id'] + $all['name']. " photo","profil",$request->file('photo'),0,$data,"photo");
        $all['belge'] = fileUpload::changeUpload($data['id'] + $all['name']. " belge","profil",$request->file('belge'),0,$data,"belge");
        $update = Worker::where('id',Auth::id())->update(['name' => $all['name'], 'email' => $all['email']]);
        if (WorkerProfile::where('workerId', '=', $data[0]['id'])->exists()) {
            $profil = WorkerProfile::where('workerId',$data[0]['id'])->update(array_filter($all));
        }
        else {
            $profil = WorkerProfile::create([
                'workerId' => $data[0]['id'],
                'name' => $all['name'],
                'email' => $all['email'],
                'phone' => $all['phone'],
                'bio' => $all['bio'],
                'photo' => $all['photo'],
                'belge' => $all['belge'],
                'il' => $all['il'],
                'ilce' => $all['ilce'],

            ]);
        }

        return redirect()->back()->with('status',"Profiliniz Başarıyla Güncellendi");
    }
}
