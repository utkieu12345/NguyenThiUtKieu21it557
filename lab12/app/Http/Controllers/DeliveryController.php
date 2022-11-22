<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Wards;
use Illuminate\Http\Request;

session_start();

class DeliveryController extends Controller
{
    public function show_delivery()
    {
        $cities = City::orderby('matp', 'ASC')->get();
        return view('admin.Delivery.add_delivery')->with(compact('cities'));
    }
    public function select_dilivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option value=""> ---Chọn Quận Huyện--- </option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value=" ' . $province->maqh . '"> ' . $province->name_province . '</option>';
                }
            } else if ($data['action'] == 'province') {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option value=""> ---Chọn Xã Phường Thị Trấn--- </option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value=" ' . $ward->xaid . '"> ' . $ward->name_ward . '</option>';
                }
            }
            echo $output;
        }
    }

    public function insert_dilivery(Request $request)
    {
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->fee_matp = $data['city'];
        $feeship->fee_maqh = $data['province'];
        $feeship->fee_maxp = $data['wards'];
        $feeship->fee_feeship = $data['fee_ship'];

        $feeship->save();
        return;
    }
    public function select_feeship()
    {
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output .= '
        <div class="card">
        <div class="card-body">
            <div style="display: flex;justify-content: space-between">
                <div class="card-title col-sm-9">Bảng Danh Sách Phí Vận Chuyển</div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input  type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-gradient-primary me-2">Tìm kiếm</button>
                        </span>
                    </div>
                </div>
            </div>
            <table style="margin-top:20px " class="table table-bordered">
                <thead>
                    <tr>
                        <th> #ID </th>
                        <th> Tỉnh Thành Phố </th>
                        <th> Quận Huyện </th>
                        <th> Xã Thị Trấn </th>
                        <th> Phí Ship </th>
                    </tr>
                </thead>
                <tbody> ';
        foreach ($feeship as $key => $fee) {
            $output .= '
                    <tr>
                        <td>' . $fee->fee_id . '</td>
                        <td>' . $fee->city->name_city . '</td>
                        <td>' . $fee->province->name_province . '</td>
                        <td>' . $fee->wards->name_ward . '</td>


                        <td contenteditable class="fee_change" data-id_fee ="' . $fee->fee_id . '">' . number_format($fee->fee_feeship, 0, ',', '.').'</td>
                    </tr>
                ';
        }
        $output .= '
                </tbody>
            </table>
        </div>
    </div>

        ';

        echo $output;

    }

    public function update_dilivery(Request $request)
    {
        $data = $request->all();
        $feeship =  Feeship::find($data['feeship_id'])->first();
        $data_feeship = rtrim($data['feeship_value'] , '.');
        $feeship->fee_feeship = $data_feeship;
        $feeship->save();
    }
}
