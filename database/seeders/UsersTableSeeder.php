<?php

namespace Database\Seeders;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Models\User;
use App\Services\WalletService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = $this->createUser(UserType::Admin, "admin");

        (new WalletService())->deposit($admin, 1000 *100000, ["name" => TransactionName::CapitalDeposit->value]);
        
        $mater_1 = $this->createUser(UserType::Master, "master_1", $admin->id);

        $agent_1 = $this->createUser(UserType::Agent, "agent_1", $mater_1->id);

        $user_1 = $this->createUser(UserType::User, "user_1", $agent_1->id);
        $user_2 = $this->createUser(UserType::User, "user_2", $agent_1->id);

        $agent_2 = $this->createUser(UserType::Agent, "agent_2", $mater_1->id);

        $user_3 = $this->createUser(UserType::User, "user_3", $agent_2->id);
        $user_4 = $this->createUser(UserType::User, "user_4", $agent_2->id);

        // $users = [
        //     [
        //         'id'             => 1,
        //         'name'           => 'Admin',
        //         'phone'          => '09123456789',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 1,
        //         'remember_token' => null,
        //         'type' => 'admin',
        //         'created_at'     => '2019-09-10 14:00:26',
        //         'updated_at'     => '2019-09-10 14:00:26',
        //     ],
        //     [
        //         'id'             => 2,
        //         'name'           => 'Master',
        //         'phone'          => '09112345678',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 2,
        //         'remember_token' => null,
        //         'type' => 'master',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],
        //     [
        //         'id'             => 3,
        //         'name'           => 'Agent',
        //         'phone'          => '09223456789',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 3,
        //         'remember_token' => null,
        //         'type' => 'agent',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],

        //     [
        //         'id'             => 4,
        //         'name'           => 'User',
        //         'phone'          => '09334567899',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 4,
        //         'remember_token' => null,
        //         'type' => 'user',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],

        //     [
        //         'id'             => 5,
        //         'name'           => 'Master A',
        //         'phone'          => '09334567890',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 1,
        //         'remember_token' => null,
        //         'type' => 'master',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],
        //     [
        //         'id'             => 6,
        //         'name'           => 'Agent A',
        //         'phone'          => '09334567891',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 5,
        //         'remember_token' => null,
        //         'type' => 'agent',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],
        //     [
        //         'id'             => 7,
        //         'name'           => 'User A',
        //         'phone'          => '09334567892',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 6,
        //         'remember_token' => null,
        //         'type' => 'admin',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],
        //     [
        //         'id'             => 8,
        //         'name'           => 'User B',
        //         'phone'          => '09334567893',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 6,
        //         'remember_token' => null,
        //         'type' => 'user',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],
        //     [
        //         'id'             => 9,
        //         'name'           => 'User C',
        //         'phone'          => '09334567894',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 6,
        //         'remember_token' => null,
        //         'type' => 'user',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ],
        //     [
        //         'id'             => 10,
        //         'name'           => 'User D',
        //         'phone'          => '09334567895',
        //         'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
        //         'agent_id'       => 6,
        //         'remember_token' => null,
        //         'type' => 'user',
        //         'created_at'     => '2023-08-14 14:00:26',
        //         'updated_at'     => '2023-08-14 14:00:26',
        //     ]
        // ];

        // User::insert($users);
    }

    private function createUser(UserType $type, $phone, $parent_id=null){
        return User::create([
            "parent_id" => $parent_id,
            "phone" => $phone,
            "name" => $phone,
            "password" =>bcrypt("password"),
            "type" => $type,
        ]);
    }
}
