<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Slider;
use Image;
use Storage;
use Validator;
use File;

class SliderController extends Controller
{
    public function getSlider()
    {
        $post = Slider::latest()->paginate(5);


        return view('backend.slider.home', compact('post'))
                ->with('i', (request()-> input('page', 1) -1) * 5);
    }

    public function addSlider()
    {
        return view('backend.slider.add');
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'title_slider' => 'required',
            'image' => 'required',
        ]);

        $title_slider = $request->title_slider;
        $slug = Str::limit(Str::slug($request->title_slider), 50, '');
        $count = count(Slider::where('url', $slug)->get());

        if($request->hasFile('image')){
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
            if($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                $image->move(public_path('images/slider/'), $nameSave);
            }else{
                $error = ['text' => 'File Harus Berformat jpg, jpeg, atau png'];
                return response()->json($error);
            }
        }

        $insert = [
            'title_slider' => $title_slider,
            'image' => $nameSave,
            'url' => $slug,
        ];

        $post = Slider::create($insert);

        
        return redirect()->route('slider.index')
                         ->with('success', 'Data Berhasil Disimpan');
    }

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('backend.slider.edit', compact('slider'));
    }

    public function updateSlider(Request $request, $id)
    {
        
        $request->validate([
            'title_slider' => 'required',
        ]);

        $title_slider = $request->title_slider;
        $slug = Str::limit(Str::slug($request->title_slider), 50, '');
        $count = count(Slider::where('url', $slug)->get());
        $image = $request->file('image');

        if($request->hasFile('image')){
            $extension = $image->getClientOriginalExtension();
            $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
            if($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                if($image = $request->file('image')){
                    $post = Slider::find($id);
                    $file_path = public_path("images/slider/".$post->image);
                    if(file_exists($file_path)){
                        unlink($file_path);
                    }

                    $nameimage = $image->getClientOriginalName();
                    $nameSave = md5(date('d-m-Y H:i:s')).'.'.$extension;
                    $image->move(public_path('images/slider/') , $nameSave); 
                }
            }else{
                $error = ['text' => 'File Harus Berformat jpg, jpeg, atau png'];
                return response()->json($error);
            }
        }
        if($image==null){
            $update = [
                'title_slider' => $title_slider,
                'url' => $slug,
            ];
        }else{
            $update = [
                'title_slider' => $title_slider,
                'image' => $nameSave,
                'url' => $slug,
            ];
        }

        $post = Slider::where('id', $id)->update($update);

        
        return redirect()->route('slider.index')
                         ->with('success', 'Data Berhasil Disimpan');
    }
    public function sliderHapus($id)
    {
        $post = Slider::find($id);

        if(file_exists(public_path()."images/slider/".$post->image)){
            unlink("images/slider/".$post->image);
            Slider::where('id', $post->id)->delete();
        }else{
            Slider::where('id', $post->id)->delete();   
        }
  
        return redirect()->route('slider.index')
                        ->with('success','Data Slider Berhasil di Delete');
    }
}
