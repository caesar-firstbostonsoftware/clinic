<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>FECALYSIS</i></h2>
                </td>
            </tr>
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
                <td style="width:21%;"><b>Requesting M.D.:</b></td>
                <td style="width:45%;">{{$Fecalyses->req_doc}}</td>
                <td style="width:10%;"><b>Date:</b></td>
                <td style="width:24%;">{{$Fecalyses->date_reg}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td><b style="font-size: 12pt;"> ROUTINE</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="width:20%;"> &nbsp;Consistency</td>
                <td style="width:30%;"> <b>{{$Fecalyses->consistency}}</b></td>
                <td style="width:20%;"> Color</td>
                <td style="width:30%;"> <b>{{$Fecalyses->color}}</b></td>
            </tr>
            <tr>
                <td style="width:20%;"> &nbsp;Red Cells</td>
                <td style="width:30%;"> <b>{{$Fecalyses->red_cell}}</b></td>
                <td style="width:20%;"> Ascaris</td>
                <td style="width:30%;"> <b>{{$Fecalyses->ascari}}</b></td>
            </tr>
            <tr>
                <td style="width:20%;"> &nbsp;Pus Cells</td>
                <td style="width:30%;"> <b>{{$Fecalyses->pus_cell}}</b></td>
                <td style="width:20%;"> Trichuris</td>
                <td style="width:30%;"> <b>{{$Fecalyses->trichuri}}</b></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="width:20%;"> <b style="font-size: 12pt;">Amoeba</b></td>
                <td style="width:30%;"> <b>{{$Fecalyses->amoeba_desc}}</b></td>
                <td style="width:20%;"> Hookworm</td>
                <td style="width:30%;"> <b>{{$Fecalyses->hookworm}}</b></td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:15%;"><b>OTHERS:</b></td>
                <td style="width:85%;"><b>{{$Fecalyses->feca_other}}</b></td>
            </tr>
            <tr>
                <td style="width:15%;"><b>REMARKS:</b></td>
                <td style="width:85%;"><b>{{$Fecalyses->remark}}</b></td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$Fecalyses->user->l_name}} {{$Fecalyses->user->f_name}} {{$Fecalyses->user->m_name}}, RMT<br>PRC Number : {{$Fecalyses->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>