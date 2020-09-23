<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return User::with('phones')->get();
    }

    public function store(Request $request)
    {
        $userData = $this->validate($request, User::getValidationRulesForMethod('create'));
        $phones = $userData['phones'];

        unset($userData['phones']);

        $user = User::create($userData);

        foreach ($phones as $phone) {
            Phone::create([
                'user_id' => $user->id,
                'phone' => $phone
            ]);
        }
    }

    public function update($id, Request $request)
    {
        $newUserData = $this->validate($request, User::getValidationRulesForMethod('update'));
        $newPhones = $newUserData['phones'];

        unset($newUserData['phones']);

        $user = User::findOrFail($id);
        $currentUserData = $user->only(['first_name', 'middle_name', 'last_name']);

        if (count($updatedData = array_diff_assoc($newUserData, $currentUserData)) > 0) {
            $user->update($updatedData);
        }

        $user->phones()->delete();
        foreach ($newPhones as $phone) {
            Phone::create([
                'user_id' => $user->id,
                'phone' => $phone
            ]);
        }
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
    }
}
