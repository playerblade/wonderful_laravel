<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
//        $users = DB::table('users')
//                 ->join('roles','users.role_id','=','roles.id')
//                 ->select('users.*','roles.role',DB::raw("CONCAT(users.last_name,' ',users.mother_last_name,' ',users.first_name) as full_name"))
//                 ->orderBy('users.id','desc')->get();
//                 ->paginate(5);
//        dd($users);
        $users = DB::select("CALL get_users_with_roles();");
//        dd($users);
//        $roles = DB::table('roles')
//                 ->orderBy('role','asc')->get();
        $roles = DB::select("CALL get_roles();");

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
//            'second_name' => ['required', 'string', 'max:255'],
//            'last_name' => ['required', 'string', 'max:255'],
//            'mother_last_name' => ['required', 'string', 'max:255'],
//            'ci' => ['required', 'string', 'max:255', 'unique:users'],
//            'user' => ['required', 'string', 'max:255'],
//            'password' => ['required', 'string', 'min:2', 'confirmed'],
//            'password' => ['required', 'string', 'min:2'],
//        ]);

//        $user = new User();
//        $user->role_id = $request->role_id;
//        $user->ci = $request->ci;
//        $user->first_name = $request->first_name;
//        $user->second_name = $request->second_name;
//        $user->last_name = $request->last_name;
//        $user->mother_last_name = $request->mother_last_name;
//        $user->gender = $request->gender;
//        $user->phone_number = $request->phone_number;
//        $user->birthday = date($request->birthday);
//        $user->user = strtolower($request->user);
//        $user->password = bcrypt($request->password);
//        $user->active = 1;
//        $user->save();

        $first_name = ucwords($request->first_name);
        $second_name = ucwords($request->second_name);
        $last_name = ucwords($request->last_name);
        $mother_last_name = ucwords($request->mother_last_name);
//        $user = strtolower($request->user);
        $user = strtolower($request->first_name.$request->mother_last_name.$request->ci);
//        $password = bcrypt($request->password);
        $password = bcrypt($request->ci);

        if (empty(DB::table('users')->where('ci',$request->ci)->first())){
            DB::insert("
                CALL insert_users_with_roles($request->role_id,'$request->ci',
                '$first_name','$second_name','$last_name',
                '$mother_last_name','$request->gender',$request->phone_number,
                '$request->birthday','$user','$password',1);
            ");
//            methods form privileges of users
            $user_db = strtolower($request->first_name);
            if ($request->role_id == 2 || $request->role_id == 4){
                $user = new User();
                $user->privilegesUsers($user_db);

            }elseif($request->role_id = 1){
                $user = new User();
                $user->privilegesUsersAdmins($user_db);
            }

            return redirect()->route('users.index') ->with('success','use saved');
        } else {
            return redirect()->route('users.index') ->with('error',' CI Already Exists!!!');
        }


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
//        select user from mysql.user;

        $user_status_orders = DB::table('user_status_orders')
                              ->where('user_id',$user->id)->first();

        $user_db = strtolower($user->first_name);

        if (empty($user_status_orders)){
            $user->delete();
            $user->deleteUsersAndPrivileges($user_db);
            return redirect()->route('users.index') ->with('success','use deleted');
        }else{
            return redirect()->route('users.index') ->with('error','not deleted, User working in Order!!!');
        }

    }
}
