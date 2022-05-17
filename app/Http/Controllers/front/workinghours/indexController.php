<?php

namespace App\Http\Controllers\front\workinghours;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\Workinghours;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {

        return view('front.workinghours.index');

    }

    public function create()
    {
        return view('front.workinghours.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $id = Auth::id();
        $hours = $all['from']. " - " .$all['to'];

        $create = Workinghours::create(['hours' => $hours, 'workerId' => $id]);
            if ($create) {
                return redirect()->back()->with('status', "Çalışma Saati Eklendi");

            } else {
                return redirect()->back()->with('statusDanger', 'İşlem Başarısız');

            }
    }

    public function edit($id)
    {
            $c = Workinghours::where('id', $id)->count();
            if ($c != 0) {
                $data = Workinghours::where('id', $id)->get();
                return view('front.workinghours.edit', ['data' => $data]);
            } else {
                return redirect('/');
            }
        }



    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Workinghours::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');


            $update = Workinghours::where('id', $id)->update($all);
            if ($update) {
                return redirect()->back()->with('status', 'Çalışma Saati Güncellendi');
            } else {
                return redirect()->back()->with('status', 'Çalışma Saati Güncellenemedi');
            }
        } else {
            return redirect('/');
        }
    }


    public function delete($id)
    {
            $c = Workinghours::where('id', $id)->count();
            if ($c != 0) {

                Workinghours::where('id', $id)->delete();

                return redirect()->back()->with('status', 'Çalışma Saati Başarıyla Silindi');
            } else {
                return redirect('/')->with('status', 'Çalışma Saati Silinemedi');
            }

    }

    public function data(Request $request)
    {
        $table = Workinghours::query()->where('workerId',Auth::id());
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('workinghours.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('workinghours.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })

            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }
}
