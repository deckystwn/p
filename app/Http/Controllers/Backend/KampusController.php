<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kampus;
use Image;
use Storage;
use Validator;
use File;

class KampusController extends Controller
{
    public function getKampus()
    {
        $post = Kampus::latest()->paginate(5);


        return view('backend.kampus.home', compact('post'))
                ->with('i', (request()-> input('page', 1) -1) * 5);
    }

    public function showFormKampus()
    {
        return view('backend.kampus.add_kampus');
    }

    public function kampusStore(Request $request)
    {
        $request->validate([
            'nama_kampus' => 'required',
            'logo' => 'required',
        ]);

        $nama_kampus = $request->nama_kampus;
        $slug = Str::limit(Str::slug($request->nama_kampus), 50, '');
        $count = count(Kampus::where('url', $slug)->get());

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $extension = $logo->getClientOriginalExtension();
            $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
            if($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                $logo->move(public_path('images/kampus/'), $nameSave);
            }else{
                $error = ['text' => 'File Harus Berformat jpg, jpeg, atau png'];
                return response()->json($error);
            }
        }

        $insert = [
            'nama_kampus' => $nama_kampus,
            'logo' => $nameSave,
            'url' => $slug,
        ];

        $post = Kampus::create($insert);

        
        return redirect()->route('kampus.index')
                         ->with('success', 'Data Berhasil Disimpan');
    }

    public function editKampus($id)
    {
        $kampus = Kampus::find($id);
        return view('backend.kampus.edit', compact('kampus'));
    }

    public function updateKampus(Request $request, $id)
    {
        $request->validate([
            'nama_kampus' => 'required',
        ]);

        $nama_kampus = $request->nama_kampus;
        $slug = Str::limit(Str::slug($request->nama_kampus), 50, '');
        $count = count(Kampus::where('url', $slug)->get());
        
        $logo = $request->file('logo');
        if($request->hasFile('logo')){
            $extension = $logo->getClientOriginalExtension();
            $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
            if($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                if($logo = $request->file('logo')){
                    $post = Kampus::find($id);
                    $file_path = public_path("images/kampus/".$post->logo);
                    if(file_exists($file_path)){
                        unlink($file_path);
                    }

                    $nameLogo = $logo->getClientOriginalName();
                    $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
                    $logo->move(public_path('images/kampus/') , $nameSave); 
                }
            }else{
                $error = ['text' => 'File Harus Berformat jpg, jpeg, atau png'];
                return response()->json($error);
            }
        }

        if($logo == null){              
            $update = [
                'nama_kampus' => $nama_kampus,
                'url' => $slug,
            ];
        }else{
            $update = [
                'nama_kampus' => $nama_kampus,
                'logo' => $nameSave,
                'url' => $slug,
            ];
        }

        $post = Kampus::where('id', $id)->update($update);

        
        return redirect()->route('kampus.index')
                         ->with('success', 'Data Berhasil Disimpan');
    }

    public function kampusHapus($id)
    {
        $post = Kampus::find($id);
        $file_path = public_path("images/kampus/".$post->logo);
        if(file_exists($file_path)){
            unlink($file_path);
            Kampus::where('id', $post->id)->delete();
        }else{
            Kampus::where('id', $post->id)->delete();  
        }
  
        return redirect()->route('kampus.index')
                        ->with('success','Data Kampus Berhasil di Delete');
    }
}
