<?php

namespace App\Http\Controllers;

use App\Models\BitCell;
use App\Tool\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class DashboardController extends Controller
{
    public function WebIndex()
    {
        return view('DashBoard.WebIndex'); #DasgBoard=檔案名稱 ,WebIndex=資料夾
    }

//    public function A1(Request $request) #回傳API
//    {
//        $TmpName = $request['Name'];
//        $TmpAge = $request['Age'];
//        $Tmpstatus = 0;
//        if ($TmpName == 'NB') {
//            $Tmpstatus = 1;
//        } else {
//            $Tmpstatus = 2;
//        }
//        $TmpResponseService = new ResponseService();
//        return $TmpResponseService->JSON_HTTP_OK([
//            'Name' => $TmpName,
//            'Status' => $Tmpstatus,
//            'Age' => $TmpAge,
//        ]);
//    }
//
//    public function A_2(Request $request) #回傳API
//    {
//        $TmpName = $request['Name'];
//        $TmpAge = $request['Age'];
//        $Tmpstatus = 0;
//        if ($TmpName == 'NB') {
//            $Tmpstatus = 1;
//        } else {
//            $Tmpstatus = 2;
//        }
//        $TmpResponseService = new ResponseService();
//        return $TmpResponseService->JSON_HTTP_OK([
//            'Name' => $TmpName,
//            'Status' => $Tmpstatus,
//            'Age' => $TmpAge,
//        ]);
//    }
    public function GetAll(Request $request)
    {
        $TmpBitcell = new BitCell;
        $BitCell = $TmpBitcell::all()->map(function ($v, $k) {
            return [
                'Guid' => $v['Guid']
                , 'Name' => $v['Name']
                , 'Address' => $v['Address']
                , 'NowValue' => $v['NowValue']
                , 'HandTrigger' => $v['HandTrigger']
                , 'HandTriggerValue' => $v['HandTriggerValue']
                , 'CollectData' => $v['CollectData']
                , 'NotifyStatus' => $v['NotifyStatus']
                , 'NotifyCollectData' => json_decode($v['NotifyCollectData'])

            ];
        });

        $TmpResponseService = new ResponseService();
        return $TmpResponseService->JSON_HTTP_OK([
            'result' => $BitCell,
            'length' => $BitCell->count(),
        ]);
    }


    public function GetByAddress(Request $request)
    {

        $TmpResponseService = new ResponseService();
        $TmpAddress = $request['Address'];
        if ($TmpAddress == '') return $TmpResponseService->HTTP_BAD_REQUEST([
            'Address' => false
        ]);

        $TmpBitcell = new BitCell;
        $TmpBitcellByWhereByAddress = $TmpBitcell::where([
            ['Address','=',$TmpAddress]
        ])->get();

        if ($TmpBitcellByWhereByAddress->isEmpty()) {
            return $TmpResponseService->HTTP_BAD_REQUEST([
                'isEmpty' => true
            ]);
        }

        $Bitcell = $TmpBitcellByWhereByAddress->map(function ($v, $k) {
            return [
                'Guid' => $v['Guid']
                , 'Name' => $v['Name']
                , 'Address' => $v['Address']
                , 'NowValue' => $v['NowValue']
                , 'HandTrigger' => $v['HandTrigger']
                , 'HandTriggerValue' => $v['HandTriggerValue']
                , 'CollectData' => $v['CollectData']
                , 'NotifyStatus' => $v['NotifyStatus']
                , 'NotifyCollectData' => json_decode($v['NotifyCollectData'])

            ];

        });
//        return $TmpResponseService->JSON_HTTP_OK([
//            'result' => $BitCell,
//            'length' => $BitCell->count(),
//        ]);
    }
    public function in_A(Request $request)
    {
        $TmpResponseService = new ResponseService();
        $TmpName = $request['Name'];
        $TmpAddress = $request['Address'];

        if ($TmpAddress == '' or $TmpName == '') return $TmpResponseService->HTTP_BAD_REQUEST([
            'Request' => false
        ]);

        $TmpBitcell = new BitCell;
        $TmpBitcell::create([
              'Guid' => guid()
            , 'Name' => $TmpName
            , 'Address' => $TmpAddress
            , 'NowValue' => 0
            , 'HandTrigger' => 99
            , 'HandTriggerValue' => 99
            , 'CollectData' => json_encode([])
            , 'NotifyStatus' => 0
            , 'NotifyCollectData' => json_encode([
                 "NotifyType"=> 0,

                 "NotifyPlatFrom"=> 0,
                 "NotifyTimeStamp"=> 0,
                 "NotifyDateTime"=> 0
             ])
        ]);
        return $TmpResponseService->JSON_HTTP_OK([
            'success' => true
        ]);

    }
    public function upd_8(Request $request)
    {
        $TmpResponseService = new ResponseService();
        $TmpGuid = $request['Guid'];
        $TmpAddress = $request['Address'];

        if ($TmpAddress == '' or $TmpGuid == '') return $TmpResponseService ->HTTP_BAD_REQUEST([
            'Request' => false
        ]);

        $TmpBitCell = new BitCell;
        $TmpBitCellByWhereGuid = $TmpBitCell::where([
            ['Guid','=',$TmpGuid]
        ])->get();

        if ($TmpBitCellByWhereGuid->isEmpty()) {
            return  $TmpResponseService->HTTP_BAD_REQUEST([
                'isEmpty' => true
            ]);
        }

        $tmpByGuid = $TmpBitCellByWhereGuid->first();
        $tmpByGuid['Address'] = $TmpAddress;
        $tmpByGuid->update();


        return $TmpResponseService->JSON_HTTP_OK([
            'success' => true
        ]);

    }
    public function del_C(Request $request)
    {
        $TmpResponseService = new ResponseService();
        $TmpGuid = $request['Guid'];

        if ( $TmpGuid == '') return $TmpResponseService ->HTTP_BAD_REQUEST([
            'Request' => false
        ]);

        $TmpBitCell = new BitCell;
        $TmpBitCellByWhereGuid = $TmpBitCell::where([
            ['Guid','=',$TmpGuid]
        ])->get();

        if ($TmpBitCellByWhereGuid->isEmpty()) {
            return  $TmpResponseService->HTTP_BAD_REQUEST([
                'isEmpty' => true
            ]);
        }

        $TmpBitCellByWhereGuid->first()->delete();


        return $TmpResponseService->JSON_HTTP_OK([
            'success' => true
        ]);
    }


######### JS
    public function Js(){

        return view('TmpJs');
    }
}


