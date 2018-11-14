<?php

namespace App\Http\Controllers\Admin;

use Alas\EmployeesQueue\EmployeesQueue;
use Validator;
use App\Profile;
use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Notifications\UserWelcome;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use SoftDeletes;

    public function index()
    {
        $users = User::withTrashed()->where("type","employee")->get();
        return view('admin.employees.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|integer',
            'birthdate' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/employees/create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->get('first_name') . ' ' . $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make('123456'),
            'type' => 'employee'
        ]);

        $profile = new Profile();
        $profile->first_name = $request->get('first_name');
        $profile->last_name = $request->get('last_name');
        $profile->user_id = $user->id;
        $profile->telephone = $request->get('phone')? $request->get('phone') : '';
        $profile->github_account = $request->get('github')? $request->get('github') : '';
        $profile->birthdate = $request->get('birthdate')? $request->get('birthdate') : '';
        $profile->save();

        // Notifications to send verification email and store a new user in database
        $user->notify(new VerifyEmail);
        $user->notify(new UserWelcome());

        return redirect()->route('admin.employees.index')->with('status', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()->find($id);

        return view('admin.employees.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.employees.edit', compact('user'));
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
        $user = User::find($id);
        $user->email = $request->get('email');
        $user->save();

        $profile = $user->profile()->first();
        if(is_null($profile)) {
            $profile = new Profile();
        }
        $profile->user_id = $user->id;
        $profile->first_name = $request->get('first_name')? $request->get('first_name') : '';
        $profile->last_name = $request->get('last_name')? $request->get('last_name') : '';
        $profile->telephone = $request->get('telephone')? $request->get('telephone') : '';
        $profile->github_account = $request->get('github_account')? $request->get('github_account') : '';
        $profile->birthdate = $request->get('birthdate')? $request->get('birthdate') : '';
        $profile->save();

        return redirect()->route('admin.employees.index')->with('status', 'User edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.employees.index')->with('status','Employee has ben successfully disabled');
    }
}
