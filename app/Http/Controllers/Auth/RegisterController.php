<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\Tenant\CreateDB;
use App\Jobs\Tenant\Migration;
use App\Models\User;
use App\Person;
use App\Providers\RouteServiceProvider;
use App\Traits\ActivationTrait;
use App\Traits\ConnectionTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use LaravelEnso\Multitenancy\Jobs\CreateDatabase;
// use LaravelEnso\Multitenancy\Jobs\Migrate;
use Illuminate\Support\Facades\Validator;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Core\Models\UserGroup;
use LaravelEnso\Multitenancy\Enums\Connections;
use LaravelEnso\Roles\Models\Role;
use Str;

class RegisterController extends Controller
{
    use RegistersUsers;
    use ActivationTrait;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        try {
            // DB::beginTransaction();
            // create person
            $person = new Person();
            $person->name = $data['name'];
            $person->email = $data['email'];
            $person->save();

            // get user_group_id
            $user_group = UserGroup::where('name', 'Administrators')->first();
            if ($user_group == null) {
                // create user_group
                $user_group = UserGroup::create(['name'=>'Administrators', 'description'=>'Administrator users group']);
            }

            // get role_id
            $role = Role::where('name', 'supervisor')->first();
            if ($role == null) {
                $role = Role::create(['menu_id'=>1, 'name'=>'supervisor', 'display_name'=>'Supervisor', 'description'=>'Supervisor role.']);
            }
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'person_id' => $person->id,
                'group_id' => $user_group->id,
                'role_id' => $role->id,
                'is_active' => 1,
            ]);
            // send verification email;

            $this->initiateEmailActivation($user);

            $company = Company::create([
                'name' => $data['name'],
                'email' => $data['email'],
                // 'is_active' => 1,
                'is_tenant' => 1,
                'status' => 1,
            ]);

//          $company->attachPerson($person->id, 'Owner');
            // DB::commit();

            $person->companies()->attach($company->id, ['person_id' => $person->id, 'is_main' => 1, 'is_mandatary' => 1, 'company_id' => $company->id]);

            // Dispatch Tenancy Jobs

            CreateDB::dispatch($company);
            Migration::dispatch($company, $data['name'], $data['email'], $data['password']);

            return $user;
        } catch (\Exception $e) {
            // DB::rollBack();
            throw $e;
        }
    }
}
