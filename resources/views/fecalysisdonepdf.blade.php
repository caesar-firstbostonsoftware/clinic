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
                <td style="width:20%;">Name:</td>
                <td style="width:50%;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</td>
                <td style="width:11%;">O.R. No.:</td>
                <td style="width:19%;">{{$Fecalyses->or_no}}</td>
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
                <td style="width:19%;">{{$Fecalyses->date_reg}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Requesting M.D.:</td>
                <td style="width:50%;">{{$Fecalyses->req_doc}}</td>
                <td style="width:11%;"></td>
                <td style="width:19%;"></td>
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
                <td style="border: 1px solid black;width:20%;"> &nbsp;Consistency :</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->consistency}}</td>
                <td style="border: 1px solid black;width:20%;"> Color :</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->color}}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> &nbsp;Red Cells :</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->red_cell}}</td>
                <td style="border: 1px solid black;width:20%;"> Ascaris :</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->ascari}}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> &nbsp;Pus Cells :</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->pus_cell}}</td>
                <td style="border: 1px solid black;width:20%;"> Trichuris :</td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->trichuri}}</td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="border: 1px solid black;width:20%;"> <b>Amoeba</b></td>
                <td style="border: 1px solid black;width:30%;"> {{$Fecalyses->amoeba_desc}}</td>
                <td style="border: 1px solid black;width:20%;"> Hookworm :</td>
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