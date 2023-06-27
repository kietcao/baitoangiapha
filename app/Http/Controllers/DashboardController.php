<?php

namespace App\Http\Controllers;

use App\Constants\Gender;
use Illuminate\Http\Request;
use App\Constants\CurrentPage;
use App\Traits\MemoryTrait;
use Illuminate\Support\Str;
use App\Models\FamilyMember;
use App\Models\User;
use App\Models\Event;

class DashboardController extends Controller
{
    use MemoryTrait;

    public function index()
    {
        $totalFamilyMembers = FamilyMember::count();
        $totalMaleFamilyMembers = FamilyMember::where('gender', Gender::MALE)->count();
        $totalFemaleFamilyMembers = FamilyMember::where('gender', Gender::FEMALE)->count();
        $newUsers = User::select('avatar', 'name', 'created_at')->orderBy('created_at', 'desc')->limit(8)->get();
        $newEvents = Event::whereDate('date', '>', now())->limit(10)->get();
        return view('admin.dashboard', [
            'totalFamilyMembers' => $totalFamilyMembers,
            'totalMaleFamilyMembers' => $totalMaleFamilyMembers,
            'totalFemaleFamilyMembers' => $totalFemaleFamilyMembers,
            'newUsers' => $newUsers,
            'diskInfo' => $this->diskInfo(),
            'cpuInfo' => $this->cpuInfo(),
            'current_page' => CurrentPage::DASHBOARD,
        ]);
    }

    public function diskInfo()
    {
        // Disk
        $totalDisk = disk_total_space(__DIR__);
        $freeDisk = disk_free_space(__DIR__);
        $usedDisk = $totalDisk - $freeDisk;

        return [
            'total_disk' => $this->byteToGb($totalDisk),
            'free_disk' => $this->byteToGb($freeDisk),
            'used_disk' => $this->byteToGb($usedDisk),
        ];
    }

    public function cpuInfo()
    {
        $os = Str::lower(PHP_OS);

        if ($os == 'linux') {
            $cpuUsage = shell_exec("top -bn1 | grep 'Cpu(s)' | awk '{print $2 + $4}'");
            $cpuUsage = isset($cpuUsage) ? $cpuUsage : 'Unknown';
        }
        else if (in_array($os, ['win', 'winnt'])) {
            $cpuUsage = shell_exec('wmic cpu get LoadPercentage /Value');
            preg_match('/(\d+)/', $cpuUsage, $matches);
            $cpuUsage = isset($matches[1]) ? $matches[1] : 'Unknown';
        }

        return [
            'cpu_used' => $cpuUsage,
        ];
    }
}
