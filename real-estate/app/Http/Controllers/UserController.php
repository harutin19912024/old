<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

use Validator;
use Auth;

class UserController extends Controller
{
	protected $paginationCount = 30;
	protected $decimal_regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$role_ids = $this->getRoles()->pluck('id')->toArray();
        $data = User::whereHas('roles', function($query) use($role_ids) {
			$query->whereIn('id', $role_ids);
		})->paginate($this->paginationCount);
		
        return view('user/index')
             ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles = $this->getRoles();
		
        return view('user/add')
                ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
			'role' => 'required|numeric',
            'name' => 'required|max:191',
            'username' => 'required|max:191|unique:users',
            'password' => 'required|max:191',
            'comission' => array('sometimes','required','regex:'. $this->decimal_regex),
            'license_expired_at' => 'sometimes|required|date_format:d-m-Y',
            'email' => 'required|email|unique:users',
        );
		
		$validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/users/create')
                ->withErrors($validator)->withInput();
        }

		if(!is_numeric(array_search($request->role, array_column($this->getRoles()->toArray(), 'id'))))
			abort(403);

        $user = new User;
		
		$user->name = $request->name;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->email = $request->email;
		$user->commision = $request->comission;
		$user->license = $request->license;
		$user->license_expired_at = date('Y-m-d', strtotime($request->license_expired_at));
		$user->mls_id = $request->mls_id;
		
		$user->save();
		
		$user->roles()->attach($request->role);
		
		//send email
		return redirect('/users');
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
    public function edit(User $user)
    {
        $roles = $this->getRoles();
		
        return view('user/add')
             ->with('data', $user)
             ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {	
        $rules = array(
			'role' => 'required|numeric',
            'name' => 'required|max:191',
            'username' => 'required|max:191|unique:users,id,' . $user->id,
            'comission' => array('sometimes','required','regex:'. $this->decimal_regex),
            'license_expired_at' => 'sometimes|required|date_format:d-m-Y',
            'email' => 'required|email|unique:users,id,' . $user->id,
        );
		
		$validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('users.edit', ['id' => $user->id])
                ->withErrors($validator)->withInput();
        }
		
		if(!is_numeric(array_search($request->role, array_column($this->getRoles()->toArray(), 'id'))))
			abort(403);

		$user->name = $request->name;
		$user->username = $request->username;
		$user->email = $request->email;
		if($request->password)
			$user->password = bcrypt($request->password);
		$user->email = $request->email;
		$user->commision = $request->comission;
		$user->license = $request->license;
		$user->license_expired_at = date('Y-m-d', strtotime($request->license_expired_at));
		$user->mls_id = $request->mls_id;
		
		$user->roles()->detach();
		$user->roles()->attach($request->role);
		
		$user->save();
		
		//send email
		return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
	
	
	public function getRoles()
	{
	
		if(Auth::user()->hasRole('agent'))
			$roles = Role::where('name', 'agent')->orderBy('name')->get();
		else if(Auth::user()->hasRole('broker'))
			$roles = Role::orderBy('name')->get();
		
		return $roles;
	}
}
