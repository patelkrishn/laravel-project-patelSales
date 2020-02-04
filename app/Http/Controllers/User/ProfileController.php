<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Address;
use Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address=Address::where('userId',Auth::user()->id)->first();
        return view('user.profile')->with(['address'=>$address]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->password!=NULL) {
            $request->validate([
                'password' => 'required|confirmed|min:8',
            ]);

            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if ($request->email!=Auth::user()->email) {
            $request->validate([
                'email' => 'unique:users,email',
            ]);

            User::where('id',Auth::user()->id)->update([
                'email' => $request->email,
            ]);
        }
        
        User::where('id',Auth::user()->id)->update([
            'name' => $request->userName,
            'gender' => $request->gender,
            'mobile' => $request->mobile,
        ]);
        return redirect()->back()->with('success', 'Details update successfully');
    }

    public function address(Request $request)
    {
        Address::where('id',$request->addressId)->update([
            'userId'=>Auth::user()->id,
            'sellerId'=>NULL,
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'street'=>$request->street,
            'landmark'=>$request->landmark,
            'city'=>$request->city,
            'state'=>$request->state,
            'country'=>$request->country,
            'pincode'=>$request->pincode,
        ]);
        return redirect()->back()->with('success', 'Address update successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
