<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();

class SliderController extends Controller
{
    public function add_slider(){
        return view('admin.Slider.add_slider');
    }
    public function save_slider(Request $request){
        $slider = new Slider();
        $slider['slider_name'] = $request->slider_name;

        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_image_name = $get_image->getClientOriginalName(); /* Lấy Tên File */
            $image_name = current(explode('.', $get_image_name)); /* VD Tên File Là nhan.jpg thì hàm explode dựa vào dấm . để phân tách thành 2 chuổi là nhan và jpg , còn hàm current để chuổi đầu , hàm end thì lấy cuối */
            $new_image = $image_name . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); /* getClientOriginalExtension() hàm lấy phần mở rộng của ảnh */
            $get_image->move('public/uploads/slider', $new_image);
            $slider['slider_image'] = $new_image;
        } else {
            $slider['slider_image'] = '';
        }

        $slider['slider_status'] = $request->slider_status;
        $slider['slider_desc'] = $request->slider_desc;

        $slider->save();
        return redirect('/all-slider');
    }

    public function all_slider(){
        $all_slider = Slider::orderby('slider_id','ASC')->get();
        return view('admin.Slider.all_slider')->with(compact('all_slider'));
    }
    public function edit_slider(Request $request){
        $slider_id = $request->slider_id;
        $slider_old = Slider::where('slider_id', $slider_id)->first();
        return view('admin.Slider.edit_slider')->with(compact('slider_old'));
    }

    public function update_slider(Request $request){
        $slider_id = $request->slider_id;
        $slider = Slider::where('slider_id', $slider_id)->first();
        $slider['slider_name'] = $request->slider_name;

        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_image_name = $get_image->getClientOriginalName(); /* Lấy Tên File */
            $image_name = current(explode('.', $get_image_name)); /* VD Tên File Là nhan.jpg thì hàm explode dựa vào dấm . để phân tách thành 2 chuổi là nhan và jpg , còn hàm current để chuổi đầu , hàm end thì lấy cuối */
            $new_image = $image_name . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); /* getClientOriginalExtension() hàm lấy phần mở rộng của ảnh */
            $get_image->move('public/uploads/slider', $new_image);
            $slider['slider_image'] = $new_image;
        } else {
            $slider['slider_image'] = '';
        }

        $slider['slider_status'] = $request->slider_status;
        $slider['slider_desc'] = $request->slider_desc;

        $slider->save();
        return redirect('/all-slider');
    }

    public function delete_slider(Request $request){
        $slider_id = $request->slider_id;
        $slider = Slider::where('slider_id', $slider_id)->first();
        $slider->delete();
        return redirect('/all-slider');
    }

    public function active_slider(Request $request){
        $slider_id = $request->slider_id;
        $slider = Slider::where('slider_id', $slider_id)->first();
        $slider['slider_status'] = 1;
        $slider->save();
        return redirect('/all-slider');
    }

    public function unactive_slider(Request $request){
        $slider_id = $request->slider_id;
        $slider = Slider::where('slider_id', $slider_id)->first();
        $slider['slider_status'] = 0;
        $slider->save();
        return redirect('/all-slider');
    }
}