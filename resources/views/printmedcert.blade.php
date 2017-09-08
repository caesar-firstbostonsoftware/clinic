<!DOCTYPE html>
<html lang="en">
<body>

<div>
    <p style="text-align: center;font-size: 25pt;"><b>MEDICAL CERTIFICATE</b></p>
    <p style="font-size: 12pt;">This is to certify that <b style="text-transform: uppercase; font-size: 16pt;">{{$name}}</b> was seen and examined last <b style="text-transform: uppercase; font-size: 14pt;">{{$aa}}</b>.</p>
    <p style="font-size: 12pt;">Diagnosis:<br> {{$diagnosis}}</p>
    <p style="font-size: 12pt;">Recommendation:<br> {{$recommendation}}</p>
</div>
<div></div>
<div>
    <p style="text-transform: uppercase; text-align: right; font-size: 14pt;"><b><u>{{$docname}}</u></b></p>
    <p style="text-align: right; font-size: 14pt;">
        @if(!$licenseNo)
        @else
            License No.: &nbsp;<b>{{$licenseNo}}</b>
        @endif
        <br>
        @if(!$ptrNo)
        @else
        PTR No.: <b>{{$ptrNo}}</b>
        @endif
    </p>
</div>
    



</body>
</html>