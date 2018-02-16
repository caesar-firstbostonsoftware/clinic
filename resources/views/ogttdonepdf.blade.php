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
                <td style="width:20%;">Name:</td>
                <td style="width:50%;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</td>
                <td style="width:11%;">O.R. No.:</td>
                <td style="width:19%;">{{$Ogtt->or_no}}</td>
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
                <td style="width:19%;">{{$Ogtt->date_reg}}</td>
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
                <td><b>50 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;1st Hour</td>
                <td style="border: 1px solid black;"> {{$Ogtt->first_hour_result}}</td>
                <td style="border: 1px solid black;"> 90 - 165 mg / dl</td>
            </tr>
            <tr>
                <td><b>75 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Fasting</td>
                <td style="border: 1px solid black;"> {{$Ogtt->fasting_result}}</td>
                <td style="border: 1px solid black;"> < 95 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;1st Hour</td>
                <td style="border: 1px solid black;"> {{$Ogtt->sv_first_hour_result}}</td>
                <td style="border: 1px solid black;"> < 180 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;2nd Hour</td>
                <td style="border: 1px solid black;"> {{$Ogtt->sv_second_hour_result}}</td>
                <td style="border: 1px solid black;"> < 155 mg / dl</td>
            </tr>
            <tr>
                <td><b>100 GRAMS</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;Fasting</td>
                <td style="border: 1px solid black;"> {{$Ogtt->oh_fasting_result}}</td>
                <td style="border: 1px solid black;"> < 95 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;1st Hour</td>
                <td style="border: 1px solid black;"> {{$Ogtt->oh_first_hour_result}}</td>
                <td style="border: 1px solid black;"> < 180 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;2nd Hour</td>
                <td style="border: 1px solid black;"> {{$Ogtt->oh_second_hour_result}}</td>
                <td style="border: 1px solid black;"> < 155 mg / dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;&nbsp;3rd Hour</td>
                <td style="border: 1px solid black;"> {{$Ogtt->oh_third_hour_result}}</td>
                <td style="border: 1px solid black;"> < 155 mg / dl</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
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