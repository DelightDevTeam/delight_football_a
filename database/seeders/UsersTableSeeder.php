<?php

namespace Database\Seeders;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Models\User;
use App\Services\WalletService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = $this->createUser(UserType::Admin, "admin");

        (new WalletService())->deposit($admin, 1000 * 100000, TransactionName::CapitalDeposit);

        $master_1 = $this->createUser(UserType::Master, "master_1", $admin->id);
        (new WalletService())->transfer($admin, $master_1, 100 * 100000, TransactionName::CreditTransfer);

        $agent_1 = $this->createUser(UserType::Agent, "agent_1", $master_1->id);
        (new WalletService())->transfer($master_1, $agent_1, 40 * 100000, TransactionName::CreditTransfer);

        $agent_2 = $this->createUser(UserType::Agent, "agent_2", $master_1->id);
        (new WalletService())->transfer($master_1, $agent_2, 40 * 100000, TransactionName::CreditTransfer);

        $user_1 = $this->createUser(UserType::User, "user_1", $agent_1->id);
        (new WalletService())->transfer($agent_1, $user_1, 20 * 100000, TransactionName::CreditTransfer);
        $user_2 = $this->createUser(UserType::User, "user_2", $agent_1->id);
        (new WalletService())->transfer($agent_1, $user_2, 15 * 100000, TransactionName::CreditTransfer);
        $user_3 = $this->createUser(UserType::User, "user_3", $agent_2->id);
        (new WalletService())->transfer($agent_2, $user_3, 10 * 100000, TransactionName::CreditTransfer);
        $user_4 = $this->createUser(UserType::User, "user_4", $agent_2->id);
        (new WalletService())->transfer($agent_2, $user_4, 5 * 100000, TransactionName::CreditTransfer);

        $master_2 = $this->createUser(UserType::Master, "master_2", $admin->id);
        (new WalletService())->transfer($admin, $master_2, 100 * 100000, TransactionName::CreditTransfer);

        $agent_3 = $this->createUser(UserType::Agent, "agent_3", $master_2->id);
        (new WalletService())->transfer($master_2, $agent_3, 40 * 100000, TransactionName::CreditTransfer);

        $agent_4 = $this->createUser(UserType::Agent, "agent_4", $master_2->id);
        (new WalletService())->transfer($master_2, $agent_4, 40 * 100000, TransactionName::CreditTransfer);

        $user_5 = $this->createUser(UserType::User, "user_5", $agent_3->id);
        (new WalletService())->transfer($agent_3, $user_5, 20 * 100000, TransactionName::CreditTransfer);
        $user_6 = $this->createUser(UserType::User, "user_6", $agent_3->id);
        (new WalletService())->transfer($agent_3, $user_6, 15 * 100000, TransactionName::CreditTransfer);
        $user_7 = $this->createUser(UserType::User, "user_7", $agent_4->id);
        (new WalletService())->transfer($agent_4, $user_7, 10 * 100000, TransactionName::CreditTransfer);
        $user_8 = $this->createUser(UserType::User, "user_8", $agent_4->id);
        (new WalletService())->transfer($agent_4, $user_8, 5 * 100000, TransactionName::CreditTransfer);
    }

    private function createUser(UserType $type, $phone, $parent_id = null)
    {
        return User::create([
            "parent_id" => $parent_id,
            "phone" => $phone,
            "username" => $phone,
            "name" => Str::title($phone),
            "password" => bcrypt("password"),
            "type" => $type,
        ]);
    }
}
