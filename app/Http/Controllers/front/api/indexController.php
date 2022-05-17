<?php

namespace App\Http\Controllers\front\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\UserAdress;
use App\Models\Workinghours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function getWorkingHours($date = "") {
        $date = ($date == "") ? date('Y-m-d') : $date;
        $returnArray = [];
        $hours = Workinghours::all();
        foreach ($hours as $k => $v){
            $control = Appointment::where('date',$date)->where('workingHour',$v['id'])->count();
            $v['isActive'] = ($control == 0) ? true : false;
            $returnArray[] = $v;
        }

        return response()->json($returnArray);
    }

    public function getWorkers() {

    }

    public function createUserAdress(Request $request) {
        $all = $request->except('_token');

        $userAdress = UserAdress::create([
            'userId' => Auth::id(),
            'adresName' => $all['adresName'],
            'il' => $all['il'],
            'adres' => $all['adres']
        ]);

        return response([
            'userAdress' => $userAdress,
           'message' => 'Adres kaydı başarılı.',200
        ]);
    }

    public function getUserAdress() {


       $userAdress = UserAdress::where('userId',Auth::id())->get();

        return response(['userAdress' => $userAdress, 200]);
    }

    public function deleteUserAdress($id) {
        $userAdress = UserAdress::find($id);

        if (!$userAdress) {
            return response([
                'message' => "Adres Bulunamadı"
            ], 403);
        }

        $userAdress->delete();

        return response([
            'message' => "Adres Başarıyla Silindi"
        ],200);
    }

}
