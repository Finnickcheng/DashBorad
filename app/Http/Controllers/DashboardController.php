<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function WebIndex()
    {
        return view('DashBoard.WebIndex'); #DasgBoard=檔案名稱 ,WebIndex=資料夾
    }
}
