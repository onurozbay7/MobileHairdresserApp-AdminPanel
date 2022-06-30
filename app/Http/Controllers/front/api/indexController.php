<?php

namespace App\Http\Controllers\front\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ServiceList;
use App\Models\User;
use App\Models\UserAdress;
use App\Models\Worker;
use App\Models\WorkerProfile;
use App\Models\Workinghours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function getWorkingHours($id,$date) {
        $date = Carbon::parse($date)->format("Y-m-d");

        $returnArray = [];
        $hours = Workinghours::where("workerId",$id)->get();
        foreach ($hours as $k => $v){
            $control = Appointment::where('date',$date)->where('workingHourId',$v['id'])->count();
            $v['isActive'] = ($control == 0) ? true : false;
            $returnArray[] = $v;
        }

        return response()->json([
            'workingHours' => $hours,
            'message' => "Başarılı", 200
        ]);
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

    public function getReelTimeAppointment(){
        $data = Appointment::where("userId",Auth::id())->orderBy('date','asc')->get();
        $allArray = [];


        foreach ($data as $k => $v){
            $workerNameData = WorkerProfile::where("workerId", $v["workerId"])->get();
            $workingHourData = Workinghours::where("id",$v['workingHourId'])->get();
            $serviceData = ServiceList::where("id", $v['serviceId'])->get();
            $returnArray = [
                "id" => $v['id'],
                "workerName" => $workerNameData[0]['name'],
                "date" => $v['date'],
                "workingHour" => $workingHourData[0]['hours'],
                "adress" => $v['adress'],
                "service" => $serviceData[0]['serviceName'],
                "text" => $v['text'],
                "isAccept" => $v["isAccept"]
            ];
            array_push($allArray,$returnArray);
        }

        return response(['appointments' => $allArray, 200]);


    }

    public function createAppointment(Request $request) {
        $all = $request->except('_token');

        $all['date'] = Carbon::parse($all['date'])->format("Y-m-d");

        $appointment = Appointment::create([
            'userId' => Auth::id(),
            'workerId' => $all['workerId'],
            'date' => $all['date'],
            'workingHourId' => $all['workingHourId'],
            'adress' => $all['adress'],
            'serviceId' => $all['serviceId'],
            'text' => $all['text'],
            'isAccept' => 0
        ]);

        return response([
            'appointment' => $appointment,
            'message' => 'Randevu kaydı başarılı.',200
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

    public function getWorkerProfile($il) {


        if ($il){
            $worker = WorkerProfile::where('il',$il)->where('isAccept',1)->get();
            if($worker){
                return response(['workers' => $worker, 200]);
            }
            else return response(['message' => "Adresinize yakın kuaför yok."]);

        }
        else {
            return response([ 'message' => 'Lütfen adres seçiniz.']);
        }
    }

    public function getWorker($id) {

            $worker = WorkerProfile::where('workerId',$id)->where('isAccept',1)->get();
            if($worker){
                return response(['worker' => $worker, 200]);
            }
            else return response(['message' => "Bir hata meydana geldi."]);

    }

    public function getServiceList($id) {
        $services = ServiceList::where('workerId',$id)->get();

        if($services) {
            return response(['services' => $services],200);
        }
        else return response(['message' => "Bir hata meydana geldi"]);
    }

}



