<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = Transaction::latest()->get();
        return view('admin.dashboard', compact('data'));
    }

    public function edit($id)
    {
        $trx = Transaction::findOrFail($id);
        return view('admin.edit', compact('trx'));
    }

    public function update(Request $r, $id)
    {
        Transaction::where('id',$id)->update($r->except('_token'));
        return redirect('/admin');
    }

    public function delete($id)
    {
        Transaction::destroy($id);
        return back();
    }

    public function done($id)
    {
        Transaction::where('id',$id)->update(['status'=>'completed']);
        return back();
    }
}
