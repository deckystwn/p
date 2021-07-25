<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.beranda');
    }

    public function getUser()
    {
        $post = User::where(['role' => 'user'])->latest()->paginate(10);
        return view('backend.user.home', compact('post'))->with('i', (request()-> input('page', 1) -1) * 10);
    }

    public function userHapus($id)
    {
        $post = User::find($id);

        User::where('id', $post->id)->delete();   
  
        return redirect()->route('user.index')
                        ->with('success','Data User Berhasil di Hapus');
    }
}
