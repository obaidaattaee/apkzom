<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    public function users(UserDataTable $dataTable)
    {
        $users = User::paginate();
        return response()->json($users);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('message', __('common.delete_successfully'));
    }

    public function show(User $user)
    {
        return view('admin.users.show')->with('user', $user);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $request->merge(['password' => bcrypt(Str::random())]);
        $user = User::create($request->only(['name' , 'email' , 'password']));
        return redirect()->route('users.index')->with('message', __('common.create_successfully'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only(['name' , 'email']));
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('message' , __('common.update_successfully'));
    }

    public function roles(){
        $roles = Role::query();

        if (request()->has('role')){
            $role = request()->input('role');
            $roles = $roles->where('display_name' , 'LIKE' , "%${role}$");
        }
        $roles = $roles->get();
        return $roles;
    }
}
