

@extends('layouts.app')

@section('content')
<div class="container">
    <div id="chart3">
        擷取區塊
        </div>
<div>
    {{$host['host']}}
</div>
        <button id="btnSave" class="btn btn-danger" onclick="screenshot()">Download screenshot</button>
        
        <script  src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script type="text/javascript">    
            function screenshot(){
                html2canvas(document.getElementById('chart3')).then(function(canvas) {
                    document.body.appendChild(canvas);
                    var a = document.createElement('a');
                    a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
                    a.download = 'image.jpg';
                    a.click();
                });
            }
        </script>
    
</div>
@endsection
