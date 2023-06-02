<?php

namespace App\Http\Controllers;

use App\Constants\Gender;
use App\Constants\Relation;
use App\Http\Requests\CreateFamilyMemberRequest;
use App\Http\Requests\CreateFirstMemberRequest;
use App\Http\Requests\UpdateFamilyMemberRequest;
use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Mail;

class FamilyMemberController extends Controller
{
    use ImageTrait;

    public function genealogy()
    {
        $members = FamilyMember::orderBy('position_index', 'asc')->get();
        return view('global.genealogy', [
            'members' => $members
        ]);
    }

    public function addFirstMemberView()
    {
        return view('admin.add_first_member');
    }

    public function storeFirstMember(CreateFirstMemberRequest $request)
    {
        $data = $request->all();
        $avatar = $this->storePublicImage($request->file('avatar'));
        $data['avatar'] = $avatar;
        FamilyMember::create($data);

        return redirect()->route('genealogy');
    }

    public function addFamilyMemberView($fromMemberId)
    {
        $fromMember = FamilyMember::findOrFail($fromMemberId);
        $couple = FamilyMember::whereIn('id', $fromMember->pids)->get();
        return view('admin.add_family_member', [
            'fromMember' => $fromMember,
            'couple' => $couple
        ]);
    }

    public function addMemberToFamily(CreateFamilyMemberRequest $request)
    {
        $relation = $request->relation;
        $current = FamilyMember::find($request->from_member_id);
        $avatar = $this->storePublicImage($request->file('avatar'));

        if ($relation == Relation::CHILD) {
            if ($current->gender == Gender::MALE) {
                $fatherId = $current->id;
                $motherId = null;

                if (!empty($request->child_with)) {
                    $motherId = FamilyMember::find($request->child_with)->id;
                }
            } else {
                $motherId = $current->id;
                $fatherId = null;

                if (!empty($request->child_with)) {
                    $fatherId = FamilyMember::find($request->child_with)->id;
                }
            }

            $dataChild = [
                'fullname' => $request->fullname,
                'role_name' => $request->role_name,
                'birthday' => $request->birthday,
                'leaveday' => $request->leaveday,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'position_index' => $request->position_index,
                'avatar' => $avatar,
                'fid' => $fatherId,
                'mid' => $motherId,
            ];

            FamilyMember::create($dataChild);
        }
        else if ($relation == Relation::COUPLE) {
            $dataCouple = [
                'fullname' => $request->fullname,
                'role_name' => $request->role_name,
                'birthday' => $request->birthday,
                'leaveday' => $request->leaveday,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'story' => $request->story,
                'gender' => $current->gender == Gender::MALE ? Gender::FEMALE : Gender::MALE,
                'avatar' => $avatar,
                'pids' => $request->from_member_id,
            ];

            $pids = $current->pids;

            $createdCouple = FamilyMember::create($dataCouple);
            $pids[] = $createdCouple->id;
            $pids = implode(',', $pids);

            $current->pids = $pids;
            $current->save();
        }

        return redirect()->route('genealogy');
    }

    public function editFamilyMemberView($id)
    {
        $member = FamilyMember::findOrFail($id);
        return view('admin.edit_family_member', [
            'member' => $member
        ]);
    }

    public function updateFamilyMember(UpdateFamilyMemberRequest $request)
    {
        $member = FamilyMember::find($request->id);
        if ($request->has('avatar')) {
            $this->removeImage($member->avatar);
            $avatar = $this->storePublicImage($request->file('avatar'));
            $member->avatar = $avatar;
        }

        if (!empty($member->position_index)) {
            $member->position_index = $request->position_index;
        }

        $member->fullname = $request->fullname;
        $member->role_name = $request->role_name;
        $member->birthday = $request->birthday;
        $member->leaveday = $request->leaveday;
        $member->address = $request->address;
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->story = $request->story;
        $member->save();

        Mail::send('welcome', [], function ($message) {
            $message->to('lethithuybinh211@gmail.com');
            $message->subject('Testing');
        });

        return redirect()->back();
    }

    public function detailMember($id)
    {
        $member = FamilyMember::findOrFail($id);
        $parent = FamilyMember::whereIn('id', [$member->fid, $member->mid])->get();
        $child = FamilyMember::where('fid', $member->id)->orWhere('mid', $member->id)->get();
        $couple = FamilyMember::whereIn('id', $member->pids)->get();
        return view('admin.detail_member', [
            'member' => $member,
            'parent' => $parent,
            'child' => $child,
            'couple' => $couple
        ]);
    }
}
