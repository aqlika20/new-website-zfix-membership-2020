@extends('layout.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif
            
            <div class="card">
                <div class="card-header">{{ __('Code') }}</div>

                <div class="card-body">
                    @if ($statusMobile == true)
                        @if ($statusCurrent == 0)
                        <form>
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label text-md-center">{{ __('Code is not registered.') }}</label>
                            </div>
                        </form>
                        @endif
                        @if ($statusCurrent == 1)
                        <form id="form" method="POST" action="{{ route('code.edit',[$code]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="screen-image" class="col-md-12 col-form-label">{{ __('Screen Image') }}<br><br>
                                    <ul style="padding-left:20px">
                                        <li>{{ __('Layar menyala') }}</li>
                                        <li>{{ __('Code terlihat jelas') }}</li>
                                        <li>{{ __('Seluruh bagian depan perangkat harus terlihat jelas') }}</li>
                                        <li>{{ __('Lepas pelindung casing dan Tempered Glass hp anda')}}</li>
                                    </ul>
                                </label>
                            
                                <div class="col-md-12 text-center">
                                    <input id="screen-image" type="file" accept="image/*" capture="camera" class="form-control" onchange="convert('screen-image', 'base64-screen-image', 'output-screen-image')" >
                                    <input type="hidden" id="base64-screen-image" name="screen_image" value="">
                                    <img id="output-screen-image" class="p-3" style="max-width: 100%">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="side-image" class="col-md-12 col-form-label">{{ __('Side Image') }}<br><br>
                                    <ul style="padding-left:20px">
                                        <li>{{ __('Layar menyala') }}</li>
                                        <li>{{ __('Sticker Hologram harus terpasang dengan benar dan jelas') }}</li>
                                        <li>{{ __('Seluruh bagian samping perangkat harus terlihat jelas') }}</li>
                                        <li>{{ __('Lepas pelindung casing dan Tempered Glass hp anda')}}</li>
                                    </ul>
                                </label>

                                <div class="col-md-12 text-center">
                                    <input id="side-image" type="file" accept="image/*" capture="camera" class="form-control" onchange="convert('side-image', 'base64-side-image', 'output-side-image')">
                                    <input type="hidden" id="base64-side-image" name="side_image" value="">
                                    <img id="output-side-image" class="p-3" style="max-width: 100%">
                                </div>
                            </div>

                            @if ($process->device_version < 10)
                            <div class="form-group row">
                                <label for="imei-image" class="col-md-12 col-form-label">{{ __('IMEI Image') }}<br><br>
                                    <ul style="padding-left:20px">
                                        <li>{{ __('Ketik *#06# di tombol telpon, kemudian IMEI akan muncul') }}</li>
                                        <li>{{ __('IMEI terlihat jelas') }}</li>
                                    </ul>
                                </label>

                                <div class="col-md-12 text-center">
                                    <input id="imei-image" type="file" accept="image/*" capture="camera" class="form-control" onchange="convert('imei-image', 'base64-imei-image', 'output-imei-image')">
                                    <input type="hidden" id="base64-imei-image" name="imei_image" value="">
                                    <img id="output-imei-image" class="p-3" style="max-width: 100%">
                                </div>
                            </div>
                            @endif

                            @if ($process->device_version >= 10)
                            <div class="form-group row">
                                <label for="imei-video" class="col-md-12 col-form-label">{{ __('IMEI Video') }}<br><br>
                                    <ul style="padding-left:20px">
                                        <li>{{ __('Merekam video dimulai 
                                        dari menekan *#06# sampai menampilkan IMEI') }}</li>
                                        <li>{{ __('Pastikan video bisa diputar') }}</li>
                                    </ul>
                                </label>

                                <div class="col-md-12 text-center">
                                    <input id="imei-video" type="file" accept="video/*" capture="camera" class="form-control" onchange="convert('imei-video', 'base64-imei-video', 'output-imei-video')">
                                    <input type="hidden" id="base64-imei-video" name="imei_video" value="">
                                    <video id="output-imei-video" class="p-3" style="max-width: 100%" controls>
                                    </video>
                                </div>
                            </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-12 text-center">
                                    <button type="button" class="btn btn-primary" onclick="check()"> 
                                        {{ __('Submit') }}
                                    </button> 
                                </div>
                            </div>
                        </form>
                        @endif
                        @if ($statusCurrent == 2)
                        <form>
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label text-md-center">{{ __('Code\'s data has been received.') }}</label>
                            </div>
                        </form>
                        @endif
                        @if ($statusCurrent == 3)
                        <form>
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label text-md-center">{{ __('Code has been expired.') }}</label>
                            </div>
                        </form>
                        @endif
                    @endif
                    @if ($statusMobile == false)
                    <form>
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label text-md-center">{{ __('Only support on mobile.') }}</label>
                        </div>
                    </form>
                    @endif
                    <p id="os"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // const _0x33cc=['src','addEventListener','FileList','getElementById','result','The\x20selected\x20file\x20does\x20not\x20appear\x20to\x20be\x20an\x20image.','target','type','File','FileReader','readAsDataURL'];(function(_0x526571,_0x33ccba){const _0x4013b5=function(_0x3e4acc){while(--_0x3e4acc){_0x526571['push'](_0x526571['shift']());}};_0x4013b5(++_0x33ccba);}(_0x33cc,0x168));const _0x4013=function(_0x526571,_0x33ccba){_0x526571=_0x526571-0x0;let _0x4013b5=_0x33cc[_0x526571];return _0x4013b5;};function outputImage(_0x3e4acc,_0x146456,_0x20dbc8){const _0x5357f4=_0x4013;if(window[_0x5357f4('0x5')]&&window[_0x5357f4('0x0')]&&window[_0x5357f4('0x1')]){const _0x4e0937=document['getElementById'](_0x146456),_0x4a2370=document[_0x5357f4('0x6')](_0x20dbc8);_0x4a2370[_0x5357f4('0x3')]='';const _0x40d1f0=_0x3e4acc['target']['files'][0x0];if(!_0x40d1f0[_0x5357f4('0xa')]){alert('The\x20File.type\x20property\x20does\x20not\x20appear\x20to\x20be\x20supported\x20on\x20this\x20browser.');return;}if(!_0x40d1f0['type']['match']('image.*')){alert(_0x5357f4('0x8'));return;}const _0x2f5b8b=new FileReader();_0x2f5b8b[_0x5357f4('0x4')]('load',_0x216bf8=>{const _0x5843a7=_0x5357f4;_0x4e0937['value']=_0x216bf8[_0x5843a7('0x9')][_0x5843a7('0x7')],_0x4a2370[_0x5843a7('0x3')]=_0x216bf8[_0x5843a7('0x9')][_0x5843a7('0x7')];}),_0x2f5b8b[_0x5357f4('0x2')](_0x40d1f0);}}

    var isVideo = false;

    document.getElementById('output-imei-video').style.display = 'none';

    function convert(input, base64, output) {
        var fileInput = document.getElementById(input);

        var reader = new FileReader();
        reader.readAsDataURL(fileInput.files[0]);

        reader.onload = function () {
            document.getElementById(base64).value = reader.result;
            document.getElementById(output).src = reader.result;
            if (output == 'output-imei-video') {
                isVideo = true;
                document.getElementById(output).style.display = 'block';
            }
        };
        reader.onerror = function (error) {
            console.log(error);
        };
    }

    function check(){
        var form = document.getElementById("form");

        if (isVideo) {
            if( document.getElementById('output-imei-video').duration > 121 ) {
                return alert ("Video tidak boleh lebih dari 2 menit.");
            }
            var output = "base64-imei-video";
        }
        else {
            var output = "base64-imei-image";
        }

        if (document.getElementById("base64-screen-image").value.length == 0 || document.getElementById("base64-side-image").value.length == 0 || document.getElementById(output).value.length == 0) {
            return alert ("Mohon isi data dengan lengkap.");
        }
        else {
            form.submit();
        }
    }
</script>
@endsection
