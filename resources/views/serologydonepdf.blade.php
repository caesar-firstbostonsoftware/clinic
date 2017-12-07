<!DOCTYPE html>
<html>
<style type="text/css">
    td{
        font-size: 10pt;
    }
</style>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>SEROLOGY</i></h2>
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
                <td style="width:19%;">{{$Serology->or_no}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Address:</td>
                <td style="width:50%;">{{$info->address}}</td>
                <td style="width:11%;">Sex:</td>
                <td style="width:19%;">{{$info->gender}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Physician:</td>
                <td style="width:50%;">{{$Serology->doctor->f_name}} {{$Serology->doctor->m_name}} {{$Serology->doctor->l_name}}, {{$Serology->doctor->credential}}</td>
                <td style="width:11%;">Date:</td>
                <td style="width:19%;">{{$Serology->serology_date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td><b>EXAMS :</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;text-align:center;"><b>RESULT</b></td>
                <td style="border: 1px solid black;text-align:center;"><b>RESULTREMARKS</b></td>
            </tr>
            @foreach($serser as $sero)
            <tr>
                <td style="border: 1px solid black;"> <b>{{$sero->adminpanel->name}}</b></td>
                <td style="border: 1px solid black;"> {{$sero->result}}</td>
                <td style="border: 1px solid black;"> {{$sero->remark}}</td>
            </tr>
            @endforeach
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:50%;">_____________________________________</td>
                <td style="width:50%;">_____________________________________, RMT</td>
            </tr>
            <tr>
                <td style="width:50%;text-align:center;">[ Name ]</td>
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