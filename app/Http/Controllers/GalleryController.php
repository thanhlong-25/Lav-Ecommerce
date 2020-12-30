<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Gallery;
use DateTime;

date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

class GalleryController extends Controller
{
    // #########################################################################################################v#######
    // ############################################ADMIN#####################################################v##########
    // Check đăng nhập
    public function authenLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function list_gallery($product_id)
    {
        $this->authenLogin();
        $pro_id = $product_id;
        return view('admin.Gallery.list_gallery')->with(compact('pro_id'));
    }

    public function load_gallery(Request $request)
    {
        $this->authenLogin();
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();

        $stt = 1;
        $output = "";
        $output .= '<table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>IMAGE</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>';
        foreach ($gallery as $key => $gallery_value) {
            $output .= '<tr>
                        <td>' . $stt . '</th>
                        <td>' . $gallery_value->gallery_id . '</td>
                        <td>' . $gallery_value->gallery_image . '</td>
                        <td><img src="' . url('public/upload/gallerys/' . $gallery_value->gallery_image) . '" width="300px" height="200px" >
                        <input class="edit_gallery" type="file" data-gallery_id="' . $gallery_value->gallery_id . '" id="edit_gallery_' . $gallery_value->gallery_id . '" accept="image/*"></td>
                        <td><button type="button" data-gallery_id="' . $gallery_value->gallery_id . '" id="delete_gallery" class="btn btn-xs btn-danger">Delete</button></td>
                    </tr>';
            $stt += 1;
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    public function add_gallery(Request $request, $product_id)
    {
        $get_image = $request->file('list_file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $today = Carbon::today();
                $month = $today->monthName;
                $day = $today->day;

                $get_name_image = $image->getClientOriginalName(); //Get name của image tải lên
                $name_image = current(explode('.', $get_name_image)); // tách chuỗi theo dấu chấm nếu không file ảnh sẽ là Gallery.jpg.12.png là ăn
                $new_image = $name_image . '-' . $month . '-' . $day . '-' .mt_rand(). '.' . $image->getClientOriginalExtension(); // tên ảnh cuối cùng
                $image->move('public/upload/gallerys', $new_image);

                $gallery = new Gallery();
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        Session::put('message', "Insert Successfully!!!");
        return redirect()->back();
    }

    public function delete_gallery(Request $request)
    {
        $gallery_id = $request->gallery_id;
        $gallery_data = Gallery::find($gallery_id);
        unlink('public/upload/gallerys/' . $gallery_data->gallery_image);
        $gallery_data->delete();
        return redirect()->back();
    }

    public function update_gallery(Request $request)
    {
        $get_image = $request->file('image_file');
        $gallery_id = $request->gallery_id;
        if ($get_image) {
                $today = Carbon::today();
                $month = $today->monthName;
                $day = $today->day;

                $get_name_image = $get_image->getClientOriginalName(); //Get name của image tải lên
                $name_image = current(explode('.', $get_name_image)); // tách chuỗi theo dấu chấm nếu không file ảnh sẽ là Gallery.jpg.12.png là ăn
                $new_image = $name_image . '-' . $month . '-' . $day . '-' .mt_rand(). '.' . $get_image->getClientOriginalExtension(); // tên ảnh cuối cùng
                $get_image->move('public/upload/gallerys', $new_image);

                $gallery = Gallery::find($gallery_id);
                unlink('public/upload/gallerys/'.$gallery->gallery_image);
                $gallery->gallery_image = $new_image;
                $gallery->save();
        }
        return redirect()->back();
    }
}
