<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Tool\ResponseService;
use Illuminate\Http\Request;

class SetPageController extends Controller
{
    public function LineAPI(Request $request)
    {
        $TmpResponseService = new ResponseService;
        $TmpLineGuid = $request['LineGuid'];
        $TmpLineToken = $request['LineToken'];

        $Setting = new Setting();
        $TmpSetting = $Setting::where([
            ['Guid', '=', $TmpLineGuid]
        ])->get()->first();

        $TmpGroup = [
            'Group' => [
                ['Token' => $TmpLineToken]
            ]
        ];

        $TmpSetting['CollectData'] = $TmpGroup;
        $TmpSetting->update();


        return $TmpResponseService->JSON_HTTP_OK([
            'Status' => true
        ]);
    }

    public function EmailAPI(Request $request)
    {
        $TmpResponseService = new ResponseService;
        $TmpEmailGuid = $request['EmailGuid'];
        $TmpEmailOwn = $request['EmailOwn'];
        $TmpEmailPwd = $request['EmailPwd'];
        $TmpToEmail = $request['ToEmail'];

        $Setting = new Setting();
        $TmpSetting = $Setting::where([
            ['Guid', '=', $TmpEmailGuid]
        ])->get()->first();

        $TmpGroup = [
            'OwnEmail' => $TmpEmailOwn,
            'Ownpassword' => $TmpEmailPwd,
            'Group' => [
                ['ToEmail' => $TmpToEmail]

            ]
        ];

        $TmpSetting['CollectData'] = $TmpGroup;
        $TmpSetting->update();


        return $TmpResponseService->JSON_HTTP_OK([
            'Status' => true
        ]);
    }

    public function SMSAPI(Request $request)
    {
        $TmpResponseService = new ResponseService;
        $TmpSMSGuid = $request['SMSGuid'];
        $TmpSMSOwn = $request['SMSOwn'];
        $TmpSMSPwd = $request['SMSPwd'];
        $TmpToSMS = $request['ToSMS'];

        $Setting = new Setting();
        $TmpSetting = $Setting::where([
            ['Guid', '=', $TmpSMSGuid]
        ])->get()->first();

        $TmpGroup = [
            'OwnPhone' => $TmpSMSOwn,
            'OwnPassword' => $TmpSMSPwd,
            'Group' => [
                ['Phone' => $TmpToSMS]

            ]
        ];

        $TmpSetting['CollectData'] = $TmpGroup;
        $TmpSetting->update();

        return $TmpResponseService->JSON_HTTP_OK([
            'Status' => true
        ]);
    }

    public function Index()
    {
        $Setting = new Setting();
        $LineGuid = '4650c0d7-ae99-40f0-9572-a3375c03e68d';
        $TmpSetting = $Setting::where([
            ['Guid', '=', $LineGuid]
        ])->get()->first();
        $LineToken = $TmpSetting['CollectData']['Group'][0]['Token'];

        $Setting = new Setting();
        $EmailGuid = 'e972137f-347a-41c7-b662-9a378de35211';
        $EmailSetting = $Setting::where([
            ['Guid', '=', $EmailGuid]
        ])->get()->first();
        $Tmpcollect = ($EmailSetting['CollectData']);

        $ToEmails = '';
        foreach ($Tmpcollect['Group'] as $key => $value) {
            $ToEmails .= $value['ToEmail'] . ',';
        }

        $ToEmails = substr($ToEmails, offset: 0, length: -1);
        $TmpEmail = [
            'EmailGuid' => $EmailGuid,
            'OwmEmail' => $Tmpcollect['OwnEmail'],
            'OwnPassword' => $Tmpcollect['Ownpassword'],
            'ToEmails' => $ToEmails
        ];


        $Setting = new Setting();
        $SMSGuid = '4605e414-192f-4667-82d1-fcbd2766255f';
        $SMSSetting = $Setting::where([
            ['Guid', '=', $SMSGuid]
        ])->get()->first();
        $Tmpcollect = $SMSSetting['CollectData'];

        $ToSMS = '';
        foreach ($Tmpcollect['Group'] as $key => $value) {
            $ToSMS .= $value['Phone'] . ',';
        }
        $ToSMS = substr($ToSMS, offset: 0, length: -1);
        $TmpSMS = [
            'SMSGuid' => $SMSGuid,
            'OwnPhone' => $Tmpcollect['OwnPhone'],
            'OwnPassword' => $Tmpcollect['OwnPassword'],
            'ToSMS' => $ToSMS
        ];


        return view('SetPage.WebIndex', compact('LineToken', 'LineGuid', 'TmpEmail', 'TmpSMS'));
    }

    public function mb_Index()
    {


        $Setting = new Setting();
        $LineGuid = '4650c0d7-ae99-40f0-9572-a3375c03e68d';
        $TmpSetting = $Setting::where([
            ['Guid', '=', $LineGuid]
        ])->get()->first();
        $LineToken = $TmpSetting['CollectData']['Group'][0]['Token'];

        $Setting = new Setting();
        $EmailGuid = 'e972137f-347a-41c7-b662-9a378de35211';
        $EmailSetting = $Setting::where([
            ['Guid', '=', $EmailGuid]
        ])->get()->first();
        $Tmpcollect = ($EmailSetting['CollectData']);

        $ToEmails = '';
        foreach ($Tmpcollect['Group'] as $key => $value) {
            $ToEmails .= $value['ToEmail'] . ',';
        }

        $ToEmails = substr($ToEmails, offset: 0, length: -1);
        $TmpEmail = [
            'EmailGuid' => $EmailGuid,
            'OwmEmail' => $Tmpcollect['OwnEmail'],
            'OwnPassword' => $Tmpcollect['Ownpassword'],
            'ToEmails' => $ToEmails
        ];


        $Setting = new Setting();
        $SMSGuid = '4605e414-192f-4667-82d1-fcbd2766255f';
        $SMSSetting = $Setting::where([
            ['Guid', '=', $SMSGuid]
        ])->get()->first();
        $Tmpcollect = $SMSSetting['CollectData'];

        $ToSMS = '';
        foreach ($Tmpcollect['Group'] as $key => $value) {
            $ToSMS .= $value['Phone'] . ',';
        }
        $ToSMS = substr($ToSMS, offset: 0, length: -1);
        $TmpSMS = [
            'SMSGuid' => $SMSGuid,
            'OwnPhone' => $Tmpcollect['OwnPhone'],
            'OwnPassword' => $Tmpcollect['OwnPassword'],
            'ToSMS' => $ToSMS
        ];


        return view('SetPage.MobileIndex', compact('LineToken', 'LineGuid', 'TmpEmail', 'TmpSMS'));
    }
}
