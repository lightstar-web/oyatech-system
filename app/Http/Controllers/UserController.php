<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Str;
use Hash;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailChangeConfirmation;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role_id > 2) {
            return view('error.401');
        } else {
            $users = User::all();
            return view('userMana.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->userMana;
        if(Auth::user()->id != $id) {
            return redirect()->route('userMana.show', ['userMana' => Auth::user()->id])->with('error', '不正なリクエストが検出されました!');
        }

        $user = User::find($id);

        return view('userMana.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nickname' => 'required',
        ]);

        $id = Auth::user()->id;
        $nickname = $request->nickname;

        $user = User::find($id);
        $user->nickname = $nickname;
        $user->save();

        return redirect()->route('userMana.show', ['userMana' => $id])
            ->with('success', '成果的に変更されました!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(Auth::user()->role_id > 2) {
            return "Unauthorized";
        }

        $id = $request->id;
        $user = User::find($id);
        $user->delete();

        return "OK";
    }

    public function verify(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if(Auth::user()->id == $id || $id == 1 || $id == 2) {
            return "FAIL";
        }

        if(Auth::user()->role_id > 2) {
            return "Unauthorized";
        }

        if($user->other === null) {
            $user->other = now();
            $user->save();
        } else {
            $user->other = null;
            $user->save();
        }

        return "OK";
    }

    public function requestChangeEmail(Request $request)
    {

        $new_email = $request->email;

        if($new_email == "") {
            return redirect()->route('userMana.show', ['userMana' => Auth::user()->id])
                ->with('error', 'この項目は必須です！');
        }

        if($new_email == Auth::user()->email) {
            return redirect()->route('userMana.show', ['userMana' => Auth::user()->id])
                ->with('error', '現在のメールと同じです!');
        }

        $user = auth()->user();
        $user->new_email = $request->email;
        $user->remember_token = Str::random(60);
        $user->save();

        Mail::to($user->new_email)->send(new EmailChangeConfirmation($user));

        return redirect()->route('userMana.show', ['userMana' => Auth::user()->id])
            ->with('success', 'メールに確認リンクをお送りしました!');
    }

    public function confirmChangeEmail($token)
    {
        $user = User::where('remember_token', $token)->firstOrFail();

        $user->email = $user->new_email;
        $user->new_email = null;
        $user->remember_token = null;
        $user->save();

        return redirect()->route('userMana.show', ['userMana' => Auth::user()->id])->with('success', 'メールは正常に変更されました！');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'last_password' => 'required',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/',
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->last_password, $user->password)) {
            return back()->withErrors(['last_password' => '前のパスワードが正しくありません。']);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('userMana.show', ['userMana' => $user->id])->with('success', 'パスワードが正常に変更されました。');
    }

    public function changeAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $user = Auth::user();
        $imageName = $user->id . '.' . $request->avatar->extension();

        $request->avatar->move(public_path('assets/images/users'), $imageName);
    
        $user->avatar = 'assets/images/users/' . $imageName;
        $user->save();
    
        return redirect()->back()->with('success', 'Avatar uploaded successfully!');
    }
}
