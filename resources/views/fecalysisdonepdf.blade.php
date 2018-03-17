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
                <td style="width:24%;">{{$Fecalyses->date_reg}}</td>
            </tr>
            <tr>
                <td style="width:20%;"><b>Requesting M.D.:</b></td>
                <td style="width:40%;">{{$Fecalyses->req_doc}}</td>
                <td style="width:16%;"></td>
                <td style="width:24%;"></td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td> <b>ROUTINE</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> &nbsp;Consistency</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->consistency}}</td>
                <td style="border: 1px solid black;width:20%;"> Color</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->color}}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> &nbsp;Red Cells</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->red_cell}}</td>
                <td style="border: 1px solid black;width:20%;"> Ascaris</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->ascari}}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> &nbsp;Pus Cells</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->pus_cell}}</td>
                <td style="border: 1px solid black;width:20%;"> Trichuris</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->trichuri}}</td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> <b>Amoeba</b></td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->amoeba_desc}}</td>
                <td style="border: 1px solid black;width:20%;"> Hookworm</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->hookworm}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:10%;"><b>OTHERS:</b></td>
                <td style="width:90%;">{{$Fecalyses->feca_other}}</td>
            </tr>
            <tr>
                <td style="width:10%;"><b>REMARKS:</b></td>
                <td style="width:90%;">{{$Fecalyses->remark}}</td>
            </tr>
            <tr><td></td></tr>
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