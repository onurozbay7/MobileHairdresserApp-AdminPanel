<?php

namespace App\Http\Controllers\front\appointment;

use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\ServiceList;
use App\Models\User;
use App\Models\Workinghours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {

        return view('front.appointment.index');

    }

    public function confirm($id){

        $c = Appointment::where('id', $id)->count();
        if ($c != 0) {
            $update = Appointment::where('id',$id)->update(['isAccept' => 1]);
            if ($update) {
                return redirect()->back()->with('status', 'Randevu Onaylandı');
            } else {
                return redirect()->back()->with('statusDanger', 'Randevu Güncellenemedi');
            }
        } else {
            return redirect('/');
        }


    }

    public function denie($id){
        $c = Appointment::where('id', $id)->count();
        if ($c != 0) {
            $update = Appointment::where('id',$id)->update(['isAccept' => 2]);
            if ($update) {
                return redirect()->back()->with('status', 'Randevu Reddedildi');
            } else {
                return redirect()->back()->with('statusDanger', 'Randevu Güncellenemedi');
            }
        } else {
            return redirect('/');
        }


    }

    public function data(Request $request)
    {
        $table = Appointment::query()->where('workerId',Auth::id());
        $data = DataTables::of($table)
            ->addColumn('confirm', function ($table) {
                if ($table->isAccept == 0){
                    return '<a class="confirmButton" href="' . route('appointment.confirm', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-check-circle list-icon"></i></a>';
                }
                else if($table->isAccept == 1){
                  return '<i title="Onaylandı" style="color:darkgreen" class="feather feather-check list-icon"></i>';
                }

                else {
                   return '<i title="Onaylandı" style="color:darkgreen" class="feather feather-x list-icon"></i>';
                }

            })
            ->addColumn('denie', function ($table) {
                if ($table->isAccept == 0){
                return '<a class="denieButton" href="' . route('appointment.denie', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-x-circle list-icon"></i></a>';
                }
                else if($table->isAccept == 1){
                    return "Onaylandı";
                }
                else{
                    return "Reddedildi";
                }
            })
            ->editColumn('userId', function ($table){
                $whData = User::where('id',$table->userId)->get();
                return $whData[0]['name'];
            })
            ->editColumn('workingHourId', function ($table){
                $whData = Workinghours::where('id',$table->workingHourId)->get();
                return $whData[0]['hours'];
            })
            ->editColumn('serviceId', function ($table){
                $whData = ServiceList::where('id',$table->serviceId)->get();
                return $whData[0]['serviceName']. " - " .$whData[0]['price']. " TL";
            })

            ->rawColumns(['confirm', 'denie'])
            ->make(true);
        return $data;
    }
}
