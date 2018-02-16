<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>URINALYSIS</i></h2>
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
                <td style="width:19%;">{{$Urinalyses->or_no}}</td>
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
                <td style="width:19%;">{{$Urinalyses->date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:25%;"><b>PHYSICAL</b></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"><b>MICROSCOPIC</b></td>
                <td style="width:20%;"></td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Color</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->color}}</td>
                <td style="border: 1px solid black;width:25%;"> WBC</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->wbc}}</td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Transparency</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->transparency}}</td>
                <td style="border: 1px solid black;width:25%;"> RBC</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->rbc}}</td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Specific Gravity</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->specific_gravity}}</td>
                <td style="border: 1px solid black;width:25%;"> Epith. Cells</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->epith_cell}}</td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:25%;"><b>CHEMICAL</b></td>
                <td style="width:25%;"></td>
                <td style="border: 1px solid black;width:25%;"> Bacteria</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->bacteria}}</td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Glucose</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->glucose}}</td>
                <td style="border: 1px solid black;width:25%;"> Cast(s)</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->cast}}</td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Bilirubin</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->bilirubin}}</td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->cast2}}</td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Ketone</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->ketone}}</td>
                <td style="border: 1px solid black;width:25%;"> Crystal(s)</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->crystal}}</td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Blood</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->blood}}</td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->crystal2}}</td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> pH</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->ph}}</td>
                <td style="border: 1px solid black;width:25%;"> Amorphous Materials</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->amorphous_material}}</td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Protein</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->protein}}</td>
                <td style="border: 1px solid black;width:25%;"> Mucus Thread</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->mucus_thread}}</td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Urobilingen</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->urobilinogen}}</td>
                <td style="border: 1px solid black;width:25%;"> Others</td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->other}}</td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Nitrites</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->nitrites}}</td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->other2}}</td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;"> Leucocytes</td>
                <td style="border: 1px solid black;width:25%;"> {{$Urinalyses->leucocytes}}</td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;"> {{$Urinalyses->other3}}</td>
                <td style="width:5%;"></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="width:25%;"><b>PREGNANCY TEST</b></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
            </tr>
            <tr>
                <td style="width:10%;"><b>REMARKS:</b></td>
                <td style="width:88%;"> {{$Urinalyses->preg_remark}}</td>
                <td style="width:1%;"></td>
                <td style="width:1%;"></td>
            </tr>
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