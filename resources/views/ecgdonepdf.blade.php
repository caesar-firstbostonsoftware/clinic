<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>Electrocardiographic Report</i></h2>
                </td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:25%;"><b>Name:</b></td>
                <td style="width:40%;"><b style="font-size: 12pt;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</b></td>
                <td style="width:15%;"><b>O.R. No.:</b></td>
                <td style="width:20%;">{{$receipt_number}}</td>
            </tr>
            <tr>
                <td style="width:25%;"><b>Address:</b></td>
                <td style="width:40%;">{{$info->address}}</td>
                <td style="width:15%;"><b>Sex / Age:</b></td>
                <td style="width:20%;">{{$info->gender}} / {{$info->age}}</td>
            </tr>
            <tr>
                <td style="width:25%;"><b>Requesting M.D.:</b></td>
                <td style="width:40%;">{{$ecg->req_doc}}</td>
                <td style="width:15%;"><b>Date:</b></td>
                <td style="width:20%;">{{$ecg->ecg_date}}</td>
            </tr>
            <tr>
                <td style="width:25%;"><b>Diagnosis:</b></td>
                <td style="width:75%;">{{$ecg->diagnosis}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid black;font-size:9pt;text-align: center;"><b>Auricular Rate</b></th>
                <th style="border: 1px solid black;font-size:9pt;text-align: center;"><b>Venticular Rate</b></th>
                <th style="border: 1px solid black;font-size:9pt;text-align: center;"><b>Rhythm</b></th>
                <th style="border: 1px solid black;font-size:9pt;text-align: center;"><b>PR Interval</b></th>
                <th style="border: 1px solid black;font-size:9pt;text-align: center;"><b>QRS Interval</b></th>
                <th style="border: 1px solid black;font-size:9pt;text-align: center;"><b>Electrical Axis</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black;text-align: center;"> {{$ecg->auricular_rate}}</td>
                <td style="border: 1px solid black;text-align: center;"> {{$ecg->venticular_rate}}</td>
                <td style="border: 1px solid black;text-align: center;"> {{$ecg->rhythm}}</td>
                <td style="border: 1px solid black;text-align: center;"> {{$ecg->pr_interval}}</td>
                <td style="border: 1px solid black;text-align: center;"> {{$ecg->qrs_interval}}</td>
                <td style="border: 1px solid black;text-align: center;"> {{$ecg->electrical_axis}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:30%;"><b>Significant Findings:</b></td>
                <td style="width:70%;">{{$ecg->significant_finding}}</td>
            </tr>
            <tr>
                <td style="width:30%;"><b>Interpretations:</b></td>
                <td style="width:70%;">{{$ecg->interpretation}}</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;">_____________________________</td>
                <td style="width:50%;">_____________________________, M.D.</td>
            </tr>
            <tr>
                <td style="width:50%;text-align:center;">Date Taken</td>
                <td style="width:50%;"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>