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
use Larinfo;

class DashboardController extends Controller
{
    use MemoryTrait;

    public function index()
    {
        $hardwareInfo = Larinfo::getServerInfoHardware();
        $totalFamilyMembers = FamilyMember::count();
        $totalMaleFamilyMembers = FamilyMember::where('gender', Gender::MALE)->count();
        $totalFemaleFamilyMembers = FamilyMember::where('gender', Gender::FEMALE)->count();
        $newUsers = User::select('avatar', 'name', 'created_at')->orderBy('created_at', 'desc')->limit(8)->get();
        $newUsersCount = User::orderBy('created_at', 'desc')->limit(8)->count();
        $newEvents = Event::whereDate('date', '>', date('Y-m-d'))->orderBy('date', 'asc')->limit(5)->get();
        return view('admin.dashboard', [
            'totalFamilyMembers' => $totalFamilyMembers,
            'totalMaleFamilyMembers' => $totalMaleFamilyMembers,
            'totalFemaleFamilyMembers' => $totalFemaleFamilyMembers,
            'newUsers' => $newUsers,
            'newUsersCount' => $newUsersCount,
            'cpuUsed' => $this->cpuUsage(),
            'cpu' => $hardwareInfo['cpu'] . ' x ' . $hardwareInfo['cpu_count'],
            'totalDisk' => $this->byteToGb($hardwareInfo['disk']['total']),
            'freeDisk' => $this->byteToGb($hardwareInfo['disk']['free']),
            'usedDisk' => $this->byteToGb($hardwareInfo['disk']['total'] - $hardwareInfo['disk']['free']),
            'newEvents' => $newEvents,
            'current_page' => CurrentPage::DASHBOARD,
        ]);
    }

    public function diskInfo()
    {
        
    }

    public function cpuUsage()
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

        return $cpuUsage;
    }
}
