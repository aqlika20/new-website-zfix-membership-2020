<?php

namespace App\Http\Controllers\BackWeb\Setting;

use App\BackWeb\Setting\UserManagement;
use App\BackWeb\Setting\StoreManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreManagementController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Store Management';
        $page_description = '';
        $stores = StoreManagement::all();

        return view('back_web.setting.store_management', compact('page_title', 'page_description', 'currentUser', 'stores')); 
    }

    public function create(Request $request) 
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('setting.store-management.index')->with(['error'=>'Data not valid.']);
        }

        StoreManagement::create($data);
        return redirect()->route('setting.store-management.index')->with(['success'=>'Data created.']);
    }

    public function view($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Edit Store Management';
        $page_description = '';
        $store = StoreManagement::find($id);
        if (!$store) {
            return redirect()->route('setting.store-management.index')->with(['error'=>'Invalid parameter id.']);
        }
        return view('back_web.setting.store_management_edit', compact('page_title', 'page_description', 'currentUser', 'store'));
    }

    public function edit($id, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('setting.store-management.index')->with(['error'=>'Data not valid.']);
        }

        $store = StoreManagement::where([
            ['id', '=', $id]
        ])->first();
        if (!$store) {
            return redirect()->route('setting.store-management.index')->with(['error'=>'Invalid parameter id.']);
        }

        $store->name = $data['name'];
        $store->address = $data['address'];

        $store->save();

        return redirect()->route('setting.store-management.index')->with(['success'=>'Data edited.']);
    }

    public function delete($id) 
    {
        $store = StoreManagement::where([
            ['id', '=', $id]
        ])->first();
        if (!$store) {
            return redirect()->route('setting.store-management.index')->with(['error'=>'Invalid parameter id.']);
        }
        StoreManagement::where('id', $id)->delete();
        return redirect()->route('setting.store-management.index')->with(['success'=>'Data deleted.']);
    }

}
