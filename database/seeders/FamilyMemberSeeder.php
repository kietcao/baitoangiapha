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
            'birthday' => '1990-12-12',
            'avatar' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aHVtYW58ZW58MHx8MHx8fDA%3D&w=1000&q=80',
            'pids' => '2',
            'gender' => Gender::MALE,
            'mid' => null,
            'fid' => null,
        ]);

        FamilyMember::create([
            'role_name' => 'Mẹ',
            'fullname' => 'Nguyễn Thị A',
            'birthday' => '1990-12-12',
            'avatar' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aHVtYW58ZW58MHx8MHx8fDA%3D&w=1000&q=80',
            'pids' => '1',
            'gender' => Gender::FEMALE,
            'mid' => null,
            'fid' => null,
        ]);

        FamilyMember::create([
            'role_name' => 'Con',
            'fullname' => 'Nguyễn Văn B',
            'birthday' => '2000-12-12',
            'avatar' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aHVtYW58ZW58MHx8MHx8fDA%3D&w=1000&q=80',
            'pids' => null,
            'gender' => Gender::MALE,
            'mid' => 2,
            'fid' => 1,
            'position_index' => 1,
        ]);

        FamilyMember::create([
            'role_name' => 'Con',
            'fullname' => 'Nguyễn Thị B',
            'birthday' => '2000-12-12',
            'avatar' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aHVtYW58ZW58MHx8MHx8fDA%3D&w=1000&q=80',
            'pids' => null,
            'gender' => Gender::FEMALE,
            'mid' => 2,
            'fid' => 1,
            'position_index' => 2,
        ]);
    }
}
