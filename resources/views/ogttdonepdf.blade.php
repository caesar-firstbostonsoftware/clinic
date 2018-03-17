<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>ORAL GLUCOSE TOLERANCE TEST</i></h2>
                </td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:15%;"><b>Name:</b></td>
                <td style="width:45%;"><b style="font-size: 12pt;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</b></td>
                <td style="width:16%;"><b>O.R. No.:</b></td>
                <td style="width:24%;">{{$receipt_number}}</td>
            </tr>
            <tr>
                <td style="width:15%;"><b>Address:</b></td>
                <td style="width:45%;">{{$info->address}}</td>
                <td style="width:16%;"><b>Sex / Age:</b></td>
                <td style="width:24%;">{{$info->gender}} / {{$info->age}}</td>
            </tr>
            <tr>
                <td style="width:15%;"></td>
                <td style="width:45%;"></td>
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
                <td><b>50 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="">&nbsp;&nbsp;1st Hour</td>
                <td style="text-align: center;"> {{$Ogtt->first_hour_result}}</td>
                <td style="text-align: center;"> 90 - 165 mg / dl</td>
            </tr>
            <tr><td></td></tr>
            @endif

            @if(!$Ogtt->fasting_result && !$Ogtt->sv_first_hour_result && !$Ogtt->sv_second_hour_result )
            @else
            <tr>
                <td><b>75 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Ogtt->fasting_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Fasting</td>
                <td style="text-align: center;"> {{$Ogtt->fasting_result}}</td>
                <td style="text-align: center;"> < 95 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->sv_first_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;1st Hour</td>
                <td style="text-align: center;"> {{$Ogtt->sv_first_hour_result}}</td>
                <td style="text-align: center;"> < 180 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->sv_second_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;2nd Hour</td>
                <td style="text-align: center;"> {{$Ogtt->sv_second_hour_result}}</td>
                <td style="text-align: center;"> < 155 mg / dl</td>
            </tr>
            @endif
            <tr><td></td></tr>
            @endif

            @if(!$Ogtt->oh_fasting_result && !$Ogtt->oh_first_hour_result && !$Ogtt->oh_second_hour_result && !$Ogtt->oh_third_hour_result)
            @else
            <tr>
                <td><b>100 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Ogtt->oh_fasting_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Fasting</td>
                <td style="text-align: center;"> {{$Ogtt->oh_fasting_result}}</td>
                <td style="text-align: center;"> < 95 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->oh_first_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;1st Hour</td>
                <td style="text-align: center;"> {{$Ogtt->oh_first_hour_result}}</td>
                <td style="text-align: center;"> < 180 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->oh_second_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;2nd Hour</td>
                <td style="text-align: center;"> {{$Ogtt->oh_second_hour_result}}</td>
                <td style="text-align: center;"> < 155 mg / dl</td>
            </tr>
            @endif
            @if(!$Ogtt->oh_third_hour_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;3rd Hour</td>
                <td style="text-align: center;"> {{$Ogtt->oh_third_hour_result}}</td>
                <td style="text-align: center;"> < 155 mg / dl</td>
            </tr>
            @endif
            <tr><td></td></tr>
            @endif
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><u><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b></u></td>
                <td style="width:50%;"> ____________________________________, RMT</td>
            </tr>
            <tr>
                <td style="width:50%;text-align:center;">Pathologist</td>
                <td style="width:50%;"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>