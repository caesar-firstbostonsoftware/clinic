<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr><td></td></tr>
            <tr>
                <td style="width:59%;"><h2><i>ORAL GLUCOSE TOLERANCE TEST</i></h2></td>
                <td style="width:1%;"></td>
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
                <td style="width:24%;">{{$Ogtt->date_reg}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    
    <table>
        <tbody>
            <tr>
                <td style=""></td>
                <td style="text-align:center;"><b style="font-size: 12pt;">Result</b></td>
                <td style="text-align:center;"><b style="font-size: 12pt;">Normal Value</b></td>
            </tr>
            @if(!$Ogtt->first_hour_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">50 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="">&nbsp;&nbsp;1st Hour</td>
                <td style="text-align: center;"> <b>{{$Ogtt->first_hour_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 90 - 165 mg / dl</td>
            </tr>
            @endif

            @if(!$Ogtt->fasting_result && !$Ogtt->sv_first_hour_result && !$Ogtt->sv_second_hour_result )
            @else
            <tr>
                <td><b style="font-size: 12pt;">75 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Ogtt->fasting_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Fasting</td>
                <td style="text-align: center;"> <b>{{$Ogtt->fasting_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 95 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->sv_first_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;1st Hour</td>
                <td style="text-align: center;"> <b>{{$Ogtt->sv_first_hour_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 180 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->sv_second_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;2nd Hour</td>
                <td style="text-align: center;"> <b>{{$Ogtt->sv_second_hour_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 155 mg / dl</td>
            </tr>
            @endif
            @endif

            @if(!$Ogtt->oh_fasting_result && !$Ogtt->oh_first_hour_result && !$Ogtt->oh_second_hour_result && !$Ogtt->oh_third_hour_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">100 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Ogtt->oh_fasting_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Fasting</td>
                <td style="text-align: center;"> <b>{{$Ogtt->oh_fasting_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 95 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->oh_first_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;1st Hour</td>
                <td style="text-align: center;"> <b>{{$Ogtt->oh_first_hour_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 180 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->oh_second_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;2nd Hour</td>
                <td style="text-align: center;"> <b>{{$Ogtt->oh_second_hour_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 155 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->oh_third_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;3rd Hour</td>
                <td style="text-align: center;"> <b>{{$Ogtt->oh_third_hour_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 155 mg / dl</td>
            </tr>
            @endif
            @endif
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    
    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$Ogtt->user->l_name}} {{$Ogtt->user->f_name}} {{$Ogtt->user->m_name}}, RMT<br>PRC Number : {{$Ogtt->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>