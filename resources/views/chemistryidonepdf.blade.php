<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr><td></td></tr>
            <tr>
                <td style="width:45%;"><h2><i>CHEMISTRY I</i></h2></td>
                <td style="width:15%;"></td>
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
                <td style="width:24%;">{{$Chemistry->date_reg}}</td>
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
            @if(!$Chemistry->fasting_result && !$Chemistry->ppbs_result && !$Chemistry->random_result && !$Chemistry->hbaic_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">BLOOD SUGAR</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Chemistry->fasting_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Fasting</td>
                <td style="text-align: center;"> <b>{{$Chemistry->fasting_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 75 - 115 mg / dl</td>
            </tr>
            @endif
            @if(!$Chemistry->ppbs_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;2-hrs PPBS</td>
                <td style="text-align: center;"> <b>{{$Chemistry->ppbs_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 70 - 150 mg / dl</td>
            </tr>
            @endif
            @if(!$Chemistry->random_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Random</td>
                <td style="text-align: center;"> <b>{{$Chemistry->random_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> > 60yO 70 - 160mg/dl <br> < 60 yO 45 - 130mg/dl </td>
            </tr>
            @endif
            @if(!$Chemistry->hbaic_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;HbAIC</td>
                <td style="text-align: center;"> <b>{{$Chemistry->hbaic_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 4.5 -6.3 %</td>
            </tr>
            @endif
            @endif

            @if(!$Chemistry->creatinine_result && !$Chemistry->bun_result && !$Chemistry->uric_acid_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">KIDNEY FUNCTION</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Chemistry->creatinine_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Creatinine</td>
                <td style="text-align: center;"> <b>{{$Chemistry->creatinine_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> M09 - 13mg/dl <br> F06 - 11mg/dl</td>
            </tr>
            @endif
            @if(!$Chemistry->bun_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;BUN</td>
                <td style="text-align: center;"> <b>{{$Chemistry->bun_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 10 - 50mg/dl</td>
            </tr>
            @endif
            @if(!$Chemistry->uric_acid_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Uric Acid</td>
                <td style="text-align: center;"> <b>{{$Chemistry->uric_acid_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> F24 - 57mg/dl</td>
            </tr>
            @endif
            @endif

            @if(!$Chemistry->sgpt_result && !$Chemistry->sgot_result && !$Chemistry->alk_phos_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">LIVER FUNCTION</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Chemistry->sgpt_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;SGPT</td>
                <td style="text-align: center;"> <b>{{$Chemistry->sgpt_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> M 0 - 42 U/L <br> F 0 - 32 U/L</td>
            </tr>
            @endif
            @if(!$Chemistry->sgot_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;SGOT</td>
                <td style="text-align: center;"> <b>{{$Chemistry->sgot_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> M 0 - 37 U/L <br> F 0 - 31 U/L</td>
            </tr>
            @endif
            @if(!$Chemistry->alk_phos_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Alk. Phos.</td>
                <td style="text-align: center;"> <b>{{$Chemistry->alk_phos_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> M 80 - 306 U/L <br> F 64 - 306 U/L</td>
            </tr>
            @endif
            @endif

            @if(!$Chemistry->hdl_cholesterol_result && !$Chemistry->triglycerides_result && !$Chemistry->total_cholesterol_result && !$Chemistry->ldl_cholesterol_result && !$Chemistry->tc_hdl_ratio_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">LIPID PROFILE</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Chemistry->hdl_cholesterol_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;HDL-Cholesterol</td>
                <td style="text-align: center;"> <b>{{$Chemistry->hdl_cholesterol_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> M > 55 mg/dl <br> F > 65 mg/dl</td>
            </tr>
            @endif
            @if(!$Chemistry->triglycerides_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Triglycerides</td>
                <td style="text-align: center;"> <b>{{$Chemistry->triglycerides_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 40 - 190 mg/dl</td>
            </tr>
            @endif
            @if(!$Chemistry->total_cholesterol_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Total Cholesterol</td>
                <td style="text-align: center;"> <b>{{$Chemistry->total_cholesterol_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 220 mg/dl</td>
            </tr>
            @endif
            @if(!$Chemistry->ldl_cholesterol_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;LDL - Cholesterol</td>
                <td style="text-align: center;"> <b>{{$Chemistry->ldl_cholesterol_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 150 mg/dl</td>
            </tr>
            @endif
            @if(!$Chemistry->tc_hdl_ratio_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;TC/HDL Ratio</td>
                <td style="text-align: center;"> <b>{{$Chemistry->tc_hdl_ratio_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> < 4.5 mg/dl</td>
            </tr>
            @endif
            @endif

            @if(!$Chemistry->sodium_result && !$Chemistry->potassium_result && !$Chemistry->calcium_result)
            @else
            <tr>
                <td><b style="font-size: 12pt;">ELECTROLYTES</b></td>
                <td></td>
                <td></td>
            </tr>
            @if(!$Chemistry->sodium_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Sodium</td>
                <td style="text-align: center;"> <b>{{$Chemistry->sodium_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> F 135 - 155 mmol/L <br> M 135 - 148 mmol/L</td>
            </tr>
            @endif
            @if(!$Chemistry->potassium_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Potassium</td>
                <td style="text-align: center;"> <b>{{$Chemistry->potassium_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 3.5 - 5.3 mmol/L</td>
            </tr>
            @endif
            @if(!$Chemistry->calcium_result)
            @else
            <tr>
                <td style="">&nbsp;&nbsp;Calcium</td>
                <td style="text-align: center;"> <b>{{$Chemistry->calcium_result}}</b></td>
                <td style="text-align: center;font-size: 7pt;"> 8.6 - 10.3 mg/dl</td>
            </tr>
            @endif
            @endif
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:15%;"><b>OTHERS:</b></td>
                <td style="width:85%;"><b>{{$Chemistry->chem_other}}</b></td>
            </tr>
            <tr>
                <td style="width:15%;"><b>REMARKS:</b></td>
                <td style="width:85%;"><b>{{$Chemistry->remark}}</b></td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$Chemistry->user->l_name}} {{$Chemistry->user->f_name}} {{$Chemistry->user->m_name}}, RMT<br>PRC Number : {{$Chemistry->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>