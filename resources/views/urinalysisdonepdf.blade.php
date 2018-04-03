<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr><td></td></tr>
            <tr>
                <td style="width:45%;"><h2><i>URINALYSIS</i></h2></td>
                <td style="width:15%;"></td>
                <td style="width:16%;"><b>O.R. No.:</b></td>
                <td style="width:24%;">{{$receipt_number}}</td>
            </tr>
            <tr>
                <td style="width:15%;"><b>Name:</b></td>
                <td style="width:45%;"><b style="font-size: 12pt;">{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}</b></td>
                <td style="width:16%;"><b>Sex / Age:</b></td>
                <td style="width:24%;">{{$info->gender}} / {{$info->age}}</td>
            </tr>
            <tr>
                <td style="width:15%;"><b>Address:</b></td>
                <td style="width:45%;">{{$info->address}}</td>
                <td style="width:16%;"><b>Date:</b></td>
                <td style="width:24%;">{{$Urinalyses->date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="width:24.5%;"><b style="font-size: 12pt;">PHYSICAL</b></td>
                <td style="width:24.5%;"></td>
                <td style="width:1%;"></td>
                <td style="width:25%;"><b style="font-size: 12pt;">MICROSCOPIC</b></td>
                <td style="width:20%;"></td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Color</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->color)
                    Negative
                    @else
                    <b>{{$Urinalyses->color}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> WBC</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->wbc)
                    Negative
                    @else
                    <b>{{$Urinalyses->wbc}}</b>
                    @endif
                </td>
                <td style="width:6%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Transparency</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->transparency)
                    Negative
                    @else
                    <b>{{$Urinalyses->transparency}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> RBC</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->rbc)
                    Negative
                    @else
                    <b>{{$Urinalyses->rbc}}</b>
                    @endif
                </td>
                <td style="width:6%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Specific Gravity</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->specific_gravity)
                    Negative
                    @else
                    <b>{{$Urinalyses->specific_gravity}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> Epith. Cells</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->epith_cell)
                    Negative
                    @else
                    <b>{{$Urinalyses->epith_cell}}</b>
                    @endif
                </td>
                <td style="width:6%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"><b style="font-size: 12pt;">CHEMICAL</b></td>
                <td style="width:24.5%;"></td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> Bacteria</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->bacteria)
                    Negative
                    @else
                    <b>{{$Urinalyses->bacteria}}</b>
                    @endif
                </td>
                <td style="width:6%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Glucose</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->glucose)
                    Negative
                    @else
                    <b>{{$Urinalyses->glucose}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> Cast(s)</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->cast)
                    Negative
                    @else
                    <b>{{$Urinalyses->cast}}</b>
                    @endif
                </td>
                <td style="width:6%;"> LPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Bilirubin</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->bilirubin)
                    Negative
                    @else
                    <b>{{$Urinalyses->bilirubin}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"></td>
                <td style="width:20%;">
                    @if(!$Urinalyses->cast2)
                    @else
                    <b>{{$Urinalyses->cast2}}</b>
                    @endif
                </td>
                <td style="width:6%;"> LPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Ketone</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->ketone)
                    Negative
                    @else
                    <b>{{$Urinalyses->ketone}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> Crystal(s)</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->crystal)
                    Negative
                    @else
                    <b>{{$Urinalyses->crystal}}</b>
                    @endif
                </td>
                <td style="width:6%;"> LPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Blood</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->blood)
                    Negative
                    @else
                    <b>{{$Urinalyses->blood}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"></td>
                <td style="width:20%;">
                    @if(!$Urinalyses->blood)
                    @else
                    <b>{{$Urinalyses->crystal2}}</b>
                    @endif
                </td>
                <td style="width:6%;"> LPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> pH</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->ph)
                    Negative
                    @else
                    <b>{{$Urinalyses->ph}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;text-align: center;font-size: 10pt;">Amorphous Materials</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->amorphous_material)
                    Negative
                    @else
                    <b>{{$Urinalyses->amorphous_material}}</b>
                    @endif
                </td>
                <td style="width:6%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Protein</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->protein)
                    Negative
                    @else
                    <b>{{$Urinalyses->protein}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> Mucus Thread</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->mucus_thread)
                    Negative
                    @else
                    <b>{{$Urinalyses->mucus_thread}}</b>
                    @endif
                </td>
                <td style="width:6%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Urobilingen</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->urobilinogen)
                    Negative
                    @else
                    <b>{{$Urinalyses->urobilinogen}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"> Others</td>
                <td style="width:20%;">
                    @if(!$Urinalyses->other)
                    Negative
                    @else
                    <b>{{$Urinalyses->other}}</b>
                    @endif
                </td>
                <td style="width:6%;"></td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Nitrites</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->nitrites)
                    Negative
                    @else
                    <b>{{$Urinalyses->nitrites}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"></td>
                <td style="width:20%;">
                    @if(!$Urinalyses->other2)
                    @else
                    <b>{{$Urinalyses->other2}}</b>
                    @endif
                </td>
                <td style="width:6%;"></td>
            </tr>
            <tr>
                <td style="width:24.5%;"> Leucocytes</td>
                <td style="width:24.5%;">
                    @if(!$Urinalyses->leucocytes)
                    Negative
                    @else
                    <b>{{$Urinalyses->leucocytes}}</b>
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="width:24%;"></td>
                <td style="width:20%;">
                    @if(!$Urinalyses->other3)
                    @else
                    <b>{{$Urinalyses->other3}}</b>
                    @endif
                </td>
                <td style="width:6%;"></td>
            </tr>
            @if($Urinalyses->pregnancy_test == 'No' && !$Urinalyses->preg_remark)
            @else
            <tr><td></td></tr>
            <tr>
                <td style="width:25%;"><b>PREGNANCY TEST</b></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
            </tr>
            <tr>
                <td style="width:12%;"><b>REMARKS:</b></td>
                <td style="width:86%;"> <b>{{$Urinalyses->preg_remark}}</b></td>
                <td style="width:1%;"></td>
                <td style="width:1%;"></td>
            </tr>
            @endif
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    
    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$Urinalyses->user->l_name}} {{$Urinalyses->user->f_name}} {{$Urinalyses->user->m_name}}, RMT<br>PRC Number : {{$Urinalyses->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>