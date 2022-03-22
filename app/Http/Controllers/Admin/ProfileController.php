<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{

  public function index($id)
  {

    // id paramater of the url can be accessed via $id
    // i.e like req.params.id
    // dd($id);

    if (auth()->user()->id == $id) {
        $user = User::find($id);
        $profile = Profile::find($id);
        return view('admin.profile.index', compact('user', 'profile'));
        } else {
        return redirect()->back();
    }
  }


    public function update(Request $request, $id)
    {
        if (auth()->user()->id == $id) {
            $profile = Profile::find($id);
            $profile->phone = $request->input('phone');
            $profile->country = $request->input('country');
            $profile->city = $request->input('city');
            $profile->address = $request->input('address');
            $profile->state = $request->input('state');
            $profile->zip = $request->input('zip');

            if($request->hasFile('avatar')){
                $destinationPath = public_path('/images/profile/');
                if (File::exists($destinationPath . $profile->avatar)) {
                    File::delete($destinationPath . $profile->avatar);
                }
                $file = $request->file('avatar');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $name);
                $profile->avatar = $name;

            }

            $profile->update();
            return redirect()->back()->with('success', 'Profile updated successfully');

        }else{
            abort(403);
        }

        //     $user = User::find($id);
        //     $user->name = $request->input('name');
        // //    check if email exists in the database
        //     if (User::where('email', $request->input('email'))->exists()) {
        //         return redirect()->back()->with('error', 'Email already exists');
        //     } else {
        //         $user->email = $request->input('email');
        //     }
        //     // check if the password are equal or not and the length is greater than 6
        //     if ($request->input('password') == $request->input('password_confirmation') && strlen($request->input('password')) > 6) {
        //         $user->password = Hash::make($request->input('password'));
        //     } else {
        //         return redirect()->back()->with('error', 'Password does not match or is too short');
        //     }

        //     $user->update();

        //     return redirect()->back()->with('success', 'Profile updated successfully');

        // }else{
        //     abort(403);




    }

}
