<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr><td></td></tr>
            <tr>
                <td style="width:15%;"><h2><i>SEROLOGY</i></h2></td>
                <td style="width:45%;"></td>
                <td style="width:16%;"><b>O.R. No.:</b></td>
                <td style="width:24%;">{{$receipt_number}}</td>
            </tr>
            <tr>
                <td style="width:15%;"><b>Name:</b></td>
                <td style="width:45%;"><b style="font-size: 12pt;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</b></td>
                <td style="width:16%;"><b>Sex / Age:</b></td>
                <td style="width:24%;">{{$info->gender}} / {{$info->age}}</td>
            </tr>
            <tr>
                <td style="width:15%;"><b>Address:</b></td>
                <td style="width:45%;">{{$info->address}}</td>
                <td style="width:16%;"><b>Date:</b></td>
                <td style="width:24%;">{{$Serology->serology_date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td><b style="font-size: 12pt;">EXAMS :</b></td>
                <td style="text-align:center;"><b style="font-size: 12pt;">RESULT</b></td>
                <td style="text-align:center;"><b style="font-size: 12pt;">RESULT REMARKS</b></td>
            </tr>
            @foreach($serser as $sero)
            @if(!$sero->result && !$sero->remark)
            @else
            <tr>
                <td style=""> <b>{{$sero->adminpanel->name}}</b></td>
                <td style="text-align: center;"> <b>{{$sero->result}}</b></td>
                <td style="text-align: center;"> <b>{{$sero->remark}}</b></td>
            </tr>
            @endif
            @endforeach
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    
    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$Serology->user->l_name}} {{$Serology->user->f_name}} {{$Serology->user->m_name}}, RMT<br>PRC Number : {{$Serology->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>