<!DOCTYPE html>
<html>
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
                <td style="width:24%;">{{$Serology->serology_date}}</td>
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
                <td style="border: 1px solid black;text-align: center;"> {{$sero->result}}</td>
                <td style="border: 1px solid black;text-align: center;"> {{$sero->remark}}</td>
            </tr>
            @endforeach
            <tr><td></td></tr>
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