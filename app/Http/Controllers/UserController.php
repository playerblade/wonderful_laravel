<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
                 ->join('roles','users.role_id','=','roles.id')
                 ->select('users.*','roles.role',DB::raw("CONCAT(users.last_name,' ',users.mother_last_name,' ',users.first_name) as full_name"))
                 ->orderBy('users.id','desc')->get();
//                 ->paginate(5);
//        dd($users);
        $roles = DB::table('roles')
                 ->orderBy('role','asc')->get();

        return view('users.crud.index',compact('users','roles'));
//        return response()->json('hello index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json('hello create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'first_name' => ['required', 'string', 'max:255'],
//            'user' => ['required', 'string', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
//        ]);

        $user = new User();
        $user->role_id = $request->role_id;
        $user->ci = $request->ci;
        $user->first_name = $request->first_name;
        $user->second_name = $request->second_name;
        $user->last_name = $request->last_name;
        $user->mother_last_name = $request->mother_last_name;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->birthday = date($request->birthday);
        $user->user = strtolower($request->user);
        $user->password = bcrypt($request->password);
        $user->active = 1;
        $user->save();

        return redirect()->route('users.index') ->with('success','use saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        dd($user);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        $request->validate([
//            'category' => 'required'
//        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
//        $user_session = DB::table('users')
//                        ->where('id',$user->id)->get();

        $user_status_orders = DB::table('user_status_orders')
                              ->where('user_id',$user->id)->get();
//        return response()->json($user_status_orders);

//        if (empty($user_session[0])){
//            $user->delete();
//            return redirect()->route('users.index') ->with('success','use deleted');
//        }else{
//            return redirect()->route('users.index') ->with('error','User is in Session!!');
//        }

        if (empty($user_status_orders[0])){
            $user->delete();
            return redirect()->route('users.index') ->with('success','use deleted');
        }else{
            return redirect()->route('users.index') ->with('error','not deleted, User working in Order!!');
        }

    }
}
