<?php

namespace App\Http\Controllers\front\servicelist;

use App\Http\Controllers\Controller;
use App\Models\ServiceList;
use App\Models\Workinghours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {

        return view('front.servicelist.index');

    }

    public function create()
    {
        return view('front.servicelist.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $id = Auth::id();


        $create = ServiceList::create(['serviceName' => $all['serviceName'], 'price' => $all['price'] ,'workerId' => $id]);
        if ($create) {
            return redirect()->back()->with('status', "Servis Eklendi");

        } else {
            return redirect()->back()->with('statusDanger', 'İşlem Başarısız');

        }
    }

    public function edit($id)
    {
        $c = ServiceList::where('id', $id)->count();
        if ($c != 0) {
            $data = ServiceList::where('id', $id)->get();
            return view('front.servicelist.edit', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }



    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = ServiceList::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');


            $update = ServiceList::where('id', $id)->update($all);
            if ($update) {
                return redirect()->back()->with('status', 'Servis Güncellendi');
            } else {
                return redirect()->back()->with('status', 'Servis Güncellenemedi');
            }
        } else {
            return redirect('/');
        }
    }


    public function delete($id)
    {
        $c = ServiceList::where('id', $id)->count();
        if ($c != 0) {

            ServiceList::where('id', $id)->delete();

            return redirect()->back()->with('status', 'Servis Başarıyla Silindi');
        } else {
            return redirect('/')->with('status', 'Servis Silinemedi');
        }

    }

    public function data(Request $request)
    {
        $table = ServiceList::query()->where('workerId',Auth::id());
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('servicelist.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('servicelist.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })

            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }
}
