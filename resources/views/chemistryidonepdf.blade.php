<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>CHEMISTRY I</i></h2>
                </td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:20%;">Name:</td>
                <td style="width:50%;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</td>
                <td style="width:11%;">O.R. No.:</td>
                <td style="width:19%;">{{$Chemistry->or_no}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Address:</td>
                <td style="width:50%;">{{$info->address}}</td>
                <td style="width:11%;">Sex:</td>
                <td style="width:19%;">{{$info->gender}}</td>
            </tr>
            <tr>
                <td style="width:20%;"></td>
                <td style="width:50%;"></td>
                <td style="width:11%;">Date:</td>
                <td style="width:19%;">{{$Chemistry->date_reg}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;text-align:center;"><b>Result</b></td>
                <td style="border: 1px solid black;text-align:center;"><b>Normal Value</b></td>
            </tr>
            <tr>
                <td><b>BLOOD SUGAR</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Fasting</td>
                <td style="border: 1px solid black;"> {{$Chemistry->fasting_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 75 - 115 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;2-hrs PPBS</td>
                <td style="border: 1px solid black;"> {{$Chemistry->ppbs_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 70 - 150 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Random</td>
                <td style="border: 1px solid black;"> {{$Chemistry->random_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> > 60yO 70 - 160mg/dl <br> < 60 yO 45 - 130mg/dl </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;HbAIC</td>
                <td style="border: 1px solid black;"> {{$Chemistry->hbaic_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 4.5 -6.3 %</td>
            </tr>
            <tr>
                <td><b>KIDNEY FUNCTION</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Creatinine</td>
                <td style="border: 1px solid black;"> {{$Chemistry->creatinine_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> M09 - 13mg/dl <br> F06 - 11mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;BUN</td>
                <td style="border: 1px solid black;"> {{$Chemistry->bun_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 10 - 50mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Uric Acid</td>
                <td style="border: 1px solid black;"> {{$Chemistry->uric_acid_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> F24 - 57mg/dl</td>
            </tr>
            <tr>
                <td><b>LIVER FUNCTION</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;SGPT</td>
                <td style="border: 1px solid black;"> {{$Chemistry->sgpt_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> M 0 - 42 U/L <br> F 0 - 32 U/L</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;SGOT</td>
                <td style="border: 1px solid black;"> {{$Chemistry->sgot_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> M 0 - 37 U/L <br> F 0 - 31 U/L</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Alk. Phos.</td>
                <td style="border: 1px solid black;"> {{$Chemistry->alk_phos_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> M 80 - 306 U/L <br> F 64 - 306 U/L</td>
            </tr>
            <tr>
                <td><b>LIPID PROFILE</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;HDL-Cholesterol</td>
                <td style="border: 1px solid black;"> {{$Chemistry->hdl_cholesterol_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> M > 55 mg/dl <br> F > 65 mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Triglycerides</td>
                <td style="border: 1px solid black;"> {{$Chemistry->triglycerides_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 40 - 190 mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Total Cholesterol</td>
                <td style="border: 1px solid black;"> {{$Chemistry->total_cholesterol_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> < 220 mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;LDL - Cholesterol</td>
                <td style="border: 1px solid black;"> {{$Chemistry->ldl_cholesterol_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> < 150 mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;TC/HDL Ratio</td>
                <td style="border: 1px solid black;"> {{$Chemistry->tc_hdl_ratio_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> < 4.5 mg/dl</td>
            </tr>
            <tr>
                <td><b>ELECTROLYTES</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Sodium</td>
                <td style="border: 1px solid black;"> {{$Chemistry->sodium_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> F 135 - 155 mmol/L <br> M 135 - 148 mmol/L</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Potassium</td>
                <td style="border: 1px solid black;"> {{$Chemistry->potassium_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 3.5 - 5.3 mmol/L</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Calcium</td>
                <td style="border: 1px solid black;"> {{$Chemistry->calcium_result}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> 8.6 - 10.3 mg/dl</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:10%;"><b>OTHERS:</b></td>
                <td style="width:90%;">{{$Chemistry->chem_other}}</td>
            </tr>
            <tr>
                <td style="width:10%;"><b>REMARKS:</b></td>
                <td style="width:90%;">{{$Chemistry->remark}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;">___________________________________________</td>
                <td style="width:50%;"> ___________________________________________, RMT</td>
            </tr>
            <tr>
                <td style="width:50%;text-align:center;"><b>ROGELIO S. McNTIRE, M.D.,FPSP</b></td>
                <td style="width:50%;"></td>
            </tr>
            <tr>
                <td style="width:50%;text-align:center;">Pathologist</td>
                <td style="width:50%;"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>