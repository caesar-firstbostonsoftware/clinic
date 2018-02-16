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
                <td style="width: 20%;">Name:</td>
                <td style="width: 48%;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</td>
                <td style="width: 1%;"></td>
                <td style="width: 1%;"></td>
                <td style="width:11%;">O.R. No.:</td>
                <td style="width: 19%;">{{$ecg->or_no}}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Address:</td>
                <td style="width: 40%;">{{$info->address}}</td>
                <td style="width:6%;">Sex:</td>
                <td style="width:14%;">{{$info->gender}}</td>
                <td style="width:6%;">Age:</td>
                <td style="width:14%;">{{$info->age}}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Requesting M.D.:</td>
                <td style="width: 58%;">{{$ecg->req_doc}}</td>
                <td style="width:1%;"></td>
                <td style="width:1%;"></td>
                <td style="width:6%;">Date:</td>
                <td style="width:14%;">{{$ecg->ecg_date}}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Diagnosis:</td>
                <td style="width:76%;">{{$ecg->diagnosis}}</td>
                <td style="width:1%;"></td>
                <td style="width:1%;"></td>
                <td style="width:1%;"></td>
                <td style="width:1%;"></td>
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
                <td style="border: 1px solid black;font-size:8pt;"> {{$ecg->auricular_rate}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> {{$ecg->venticular_rate}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> {{$ecg->rhythm}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> {{$ecg->pr_interval}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> {{$ecg->qrs_interval}}</td>
                <td style="border: 1px solid black;font-size:8pt;"> {{$ecg->electrical_axis}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:25%;">Significant Findings:</td>
                <td style="width:75%;">{{$ecg->significant_finding}}</td>
            </tr>
            <tr>
                <td style="width:25%;">Interpretations:</td>
                <td style="width:75%;">{{$ecg->interpretation}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;">___________________________________________</td>
                <td style="width:50%;">___________________________________________, M.D.</td>
            </tr>
            <tr>
                <td style="width:50%;text-align:center;">Date Taken</td>
                <td style="width:50%;"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>