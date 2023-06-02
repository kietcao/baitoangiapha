<?php

namespace Database\Seeders;

use App\Constants\Gender;
use Illuminate\Database\Seeder;
use App\Models\FamilyMember;

class FamilyMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyMember::create([
            'role_name' => 'Cha',
            'fullname' => 'Nguyễn Văn A',
            'birthday' => date('Y-m-d'),
            'avatar' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aHVtYW58ZW58MHx8MHx8fDA%3D&w=1000&q=80',
            'pids' => null,
            'gender' => Gender::MALE,
            'mid' => null,
            'fid' => null,
        ]);
    }
}
