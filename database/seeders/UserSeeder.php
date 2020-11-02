<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Core\Models\UserGroup;
use LaravelEnso\People\Enums\Titles;
use LaravelEnso\People\Models\Person;
use LaravelEnso\Roles\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $person = $this->person();

        User::factory()->create([
            'person_id' => $person->id,
            'group_id' => UserGroup::whereName('Administrators')->first()->id,
            'email' => $person->email,
            'password' => '$2y$10$06TrEefmqWBO7xghm2PUzeF/O0wcawFUv8TKYq.NF6Dsa0Pnmd/F2',
            'role_id' => Role::whereName('admin')->first()->id,
            'is_active' => true,
        ])->generateAvatar();
    }

    private function person()
    {
        return Person::factory()->create([
            'title' => Titles::Mr,
            'name' => 'Admin Root',
            'appellative' => 'Admin',
            'email' => 'admin@genealogia.co.uk',
            'birthday' => '1970-01-01',
            'phone' => '+4412345678910',
        ]);
    }
}
