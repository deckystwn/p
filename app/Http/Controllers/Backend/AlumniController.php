<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Kampus;
use App\Models\Alumni;
use Image;
use Storage;
use Validator;
use File;

class AlumniController extends Controller
{
    public function getKampus()
    {
        $post = Kampus::all();
        return view('backend.alumni.index', compact('post'));
    }

    public function getAlumni($id)
    {
        $kampus = Kampus::find($id);
        $alumni = DB::table('kampus')->join('alumni', 'kampus.id', '=', 'alumni.kampus_id')
                ->where('kampus_id', $id)
                ->paginate(10);
        return view('backend.alumni.home', compact('kampus', 'alumni'));
    }

    public function addAlumni($id)
    {
        $kampus = Kampus::find($id);
        return view('backend.alumni.add_alumni', compact('kampus'));
    }

    public function alumniStore(Request $request)
    {
        $request->validate([
            'foto'          => 'required',
            'nama_lengkap'  => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'jurusan'       => 'required',
            'fakultas'      => 'required',
            'angkatan'      => 'required',
            'alumni'        => 'required',
            'no_wa'         => 'required',
            'akun_ig'       => 'required',
        ]);

        $kampus_id      = $request->kampus_id;
        $nama_lengkap   = $request->nama_lengkap;
        $jenis_kelamin  = $request->jenis_kelamin;
        $alamat         = $request->alamat;
        $jurusan        = $request->jurusan;    
        $fakultas       = $request->fakultas;   
        $angkatan       = $request->angkatan;   
        $alumni         = $request->alumni;     
        $no_wa          = $request->no_wa;
        $akun_ig        = $request->akun_ig;
        $slug           = Str::limit(Str::slug($request->nama_lengkap), 100, '');
        $count          = count(Alumni::where('url', $slug)->get()); 

        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
            if($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                $foto->move(public_path('images/alumni/'), $nameSave);
            }else{
                $error = ['text' => 'File Harus Berformat jpg, jpeg, atau png'];
                return response()->json($error);
            }
        }
        
        $insert = ([
            'kampus_id'     => $kampus_id,
            'foto'          => $nameSave,
            'nama_lengkap'  => $nama_lengkap,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat'        => $alamat,
            'jurusan'       => $jurusan,
            'fakultas'      => $fakultas,
            'angkatan'      => $angkatan,
            'alumni'        => $alumni,
            'no_wa'         => $no_wa,
            'akun_ig'       => $akun_ig,
            'url'           => $slug,
        ]);

        $post = Alumni::create($insert);

        return redirect()->route('alumni.home', $kampus_id)
                         ->with('success', 'Data Berhasil Disimpan');
    }

    public function editAlumni($id)
    {
        $alumni = Alumni::find($id);
        $dalumni = DB::table('kampus')->join('alumni', 'kampus.id', '=', 'alumni.kampus_id')
                ->where('kampus_id', $id)
                ->get();
        $kampus = Kampus::all();
        return view('backend.alumni.edit', compact('alumni', 'kampus', 'dalumni'));
    }

    public function updateAlumni(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'  => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'jurusan'       => 'required',
            'fakultas'      => 'required',
            'angkatan'      => 'required',
            'alumni'        => 'required',
            'no_wa'         => 'required',
            'akun_ig'       => 'required',
        ]);

        $kampus_id      = $request->kampus_id;
        $nama_lengkap   = $request->nama_lengkap;
        $jenis_kelamin  = $request->jenis_kelamin;
        $alamat         = $request->alamat;
        $jurusan        = $request->jurusan;    
        $fakultas       = $request->fakultas;   
        $angkatan       = $request->angkatan;   
        $alumni         = $request->alumni;     
        $no_wa          = $request->no_wa;
        $akun_ig        = $request->akun_ig;
        $slug           = Str::limit(Str::slug($request->nama_lengkap), 100, '');
        $count          = count(Alumni::where('url', $slug)->get()); 
        
        $foto = $request->file('foto');

        if($request->hasFile('foto')){
            $extension = $foto->getClientOriginalExtension();
            $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
            if($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                if($foto = $request->file('foto')){
                    $post = Alumni::find($id);
                    $file_path = public_path("images/alumni/".$post->foto);
                    if(file_exists($file_path)){
                        unlink($file_path);
                    }

                    $namefoto = $foto->getClientOriginalName();
                    $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
                    $foto->move(public_path('images/alumni/') , $nameSave); 
                }
            }else{
                $error = ['text' => 'File Harus Berformat jpg, jpeg, atau png'];
                return response()->json($error);
            }
        }
        if($foto==null){
            $update = ([
                'kampus_id'     => $kampus_id,
                'nama_lengkap'  => $nama_lengkap,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat'        => $alamat,
                'jurusan'       => $jurusan,
                'fakultas'      => $fakultas,
                'angkatan'      => $angkatan,
                'alumni'        => $alumni,
                'no_wa'         => $no_wa,
                'akun_ig'       => $akun_ig,
                'url'           => $slug,
            ]);
        }else{
            $update = ([
                'kampus_id'     => $kampus_id,
                'foto'          => $nameSave,
                'nama_lengkap'  => $nama_lengkap,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat'        => $alamat,
                'jurusan'       => $jurusan,
                'fakultas'      => $fakultas,
                'angkatan'      => $angkatan,
                'alumni'        => $alumni,
                'no_wa'         => $no_wa,
                'akun_ig'       => $akun_ig,
                'url'           => $slug,
            ]);
        }

        $post = Alumni::where('id', $id)->update($update);

        return redirect()->route('alumni.home', $kampus_id)
                         ->with('success', 'Data Berhasil Disimpan');
    }

    public function alumniHapus($id)
    {
        $post = Alumni::find($id);
        $file_path = public_path("images/alumni/".$post->foto);
        if(file_exists($file_path)){
            unlink($file_path);
            Alumni::where('id', $post->id)->delete();
        }else{
            Alumni::where('id', $post->id)->delete(); 
        }
  
        return redirect()->route('alumni.home', $post->kampus_id)
                        ->with('success','Data Alumni Berhasil di Delete');
    }

}
