@extends('Share.Mobile2Layout')

@section('Title')
    設定
@stop

@section('Content')
    <div class="box">
        <p class="mb-2">Line 通知</p>
        <label class="sub">金鑰</label>
        <input id="Input_Line" value="{{$LineToken}}" class="form-control">
        <div class="text-end pt-3">
            <button id="BtnLine" data-guid="{{$LineGuid}}" class="btn btn_main">更新</button>
        </div>
        <hr/>
        <p class="mb-2">信箱</p>
        <label class="sub">帳號</label>
        <input id="Input_Email_OwnID" value="{{$TmpEmail['OwmEmail']}}" class="form-control">
        <label class="sub">密碼</label>
        <input id="Input_Email_OwnPassword" value="{{$TmpEmail['OwnPassword']}}" class="form-control">
        <label class="sub">發送者(群)</label>
        <input id="Input_Email_Tos" value="{{$TmpEmail['ToEmails']}}" class="form-control">
        <div class="text-end pt-3">
            <button id="BtnEmail" data-guid="{{$TmpEmail['EmailGuid']}}" class="btn btn_main">更新</button>
        </div>
        <hr/>
        <p class="mb-2">簡訊</p>
        <label class="sub">帳號</label>
        <input id="Input_SMS_ID" value="{{$TmpSMS['OwnPhone']}}" class="form-control">
        <label class="sub">密碼</label>
        <input id="Input_SMS_Password" value="{{$TmpSMS['OwnPassword']}}" type="password" class="form-control">
        <label class="sub">剩餘量</label>
        <input id="Input_SMS_Tos" value="{{$TmpSMS['ToSMS']}}" class="form-control">
        <div class="text-end pt-3">
            <button id="BtnSMS" data-guid="{{$TmpSMS['SMSGuid']}}" class="btn btn_main">更新</button>
        </div>
        <hr/>
    </div>
@stop

@section('Js')
    <script>

        $("#BtnLine").click(function (v){
            let getLineToken = $("#Input_Line").val();
            let getLineGuid = v.target.dataset.guid;
            fetch(`http://127.0.0.1:81/LineAPI?LineGuid=${getLineGuid}&LineToken=${getLineToken}`)
                .then(res => res.json())
                .then(data =>{
                    location.reload();
                });
            // console.log(v);
        });

        $("#BtnEmail").click(function (v) {
            let TmpOwnID = $("#Input_Email_OwnID").val();
            let TmpOwnPwd = $("#Input_Email_OwnPassword").val();
            let TmpOwnTos = $("#Input_Email_Tos").val();
            let getEmailGuid = v.target.dataset.guid;
            const url = `http://127.0.0.1:81/EmailAPI?EmailGuid=${getEmailGuid}&EmailOwn=${TmpOwnID}&EmailPwd=${TmpOwnPwd}&ToEmail=${TmpOwnTos}`
            fetch(url)
                .then(res => res.json())
                .then(data =>{
                    location.reload();
                });
        })

        $("#BtnSMS").click(function (v) {
            let TmpOwnID = $("#Input_SMS_ID").val();
            let TmpOwnPwd = $("#Input_SMS_Password").val();
            let TmpOwnTos = $("#Input_SMS_Tos").val();
            let getSMSGuid = v.target.dataset.guid;
            const url = `http://127.0.0.1:81/SMSAPI?SMSGuid=${getSMSGuid}&SMSOwn=${TmpOwnID}&SMSPwd=${TmpOwnPwd}&ToSMS=${TmpOwnTos}`
            fetch(url)
                .then(res => res.json())
                .then(data =>{
                    location.reload();
                });
        })
    </script>
@stop
