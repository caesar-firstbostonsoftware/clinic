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
                <td style="width:24%;">{{$Urinalyses->date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="width:24.5%;"><b>PHYSICAL</b></td>
                <td style="width:24.5%;"></td>
                <td style="width:1%;"></td>
                <td style="width:25%;"><b>MICROSCOPIC</b></td>
                <td style="width:20%;"></td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Color</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->color)
                    Negative
                    @else
                    {{$Urinalyses->color}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> WBC</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->wbc)
                    Negative
                    @else
                    {{$Urinalyses->wbc}}
                    @endif
                </td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Transparency</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->transparency)
                    Negative
                    @else
                    {{$Urinalyses->transparency}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> RBC</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->rbc)
                    Negative
                    @else
                    {{$Urinalyses->rbc}}
                    @endif
                </td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Specific Gravity</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->specific_gravity)
                    Negative
                    @else
                    {{$Urinalyses->specific_gravity}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Epith. Cells</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->epith_cell)
                    Negative
                    @else
                    {{$Urinalyses->epith_cell}}
                    @endif
                </td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="width:24.5%;"><b>CHEMICAL</b></td>
                <td style="width:24.5%;"></td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Bacteria</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->bacteria)
                    Negative
                    @else
                    {{$Urinalyses->bacteria}}
                    @endif
                </td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Glucose</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->glucose)
                    Negative
                    @else
                    {{$Urinalyses->glucose}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Cast(s)</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->cast)
                    Negative
                    @else
                    {{$Urinalyses->cast}}
                    @endif
                </td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Bilirubin</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->bilirubin)
                    Negative
                    @else
                    {{$Urinalyses->bilirubin}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->cast2)
                    @else
                    {{$Urinalyses->cast2}}
                    @endif
                </td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Ketone</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->ketone)
                    Negative
                    @else
                    {{$Urinalyses->ketone}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Crystal(s)</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->crystal)
                    Negative
                    @else
                    {{$Urinalyses->crystal}}
                    @endif
                </td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Blood</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->blood)
                    Negative
                    @else
                    {{$Urinalyses->blood}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->blood)
                    @else
                    {{$Urinalyses->crystal2}}
                    @endif
                </td>
                <td style="width:5%;"> LPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> pH</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->ph)
                    Negative
                    @else
                    {{$Urinalyses->ph}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Amorphous Materials</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->amorphous_material)
                    Negative
                    @else
                    {{$Urinalyses->amorphous_material}}
                    @endif
                </td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Protein</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->protein)
                    Negative
                    @else
                    {{$Urinalyses->protein}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Mucus Thread</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->mucus_thread)
                    Negative
                    @else
                    {{$Urinalyses->mucus_thread}}
                    @endif
                </td>
                <td style="width:5%;"> HPF</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Urobilingen</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->urobilinogen)
                    Negative
                    @else
                    {{$Urinalyses->urobilinogen}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"> Others</td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->other)
                    Negative
                    @else
                    {{$Urinalyses->other}}
                    @endif
                </td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Nitrites</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->nitrites)
                    Negative
                    @else
                    {{$Urinalyses->nitrites}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->other2)
                    @else
                    {{$Urinalyses->other2}}
                    @endif
                </td>
                <td style="width:5%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:24.5%;"> Leucocytes</td>
                <td style="border: 1px solid black;width:24.5%;">
                    @if(!$Urinalyses->leucocytes)
                    Negative
                    @else
                    {{$Urinalyses->leucocytes}}
                    @endif
                </td>
                <td style="width:1%;"></td>
                <td style="border: 1px solid black;width:25%;"></td>
                <td style="border: 1px solid black;width:20%;">
                    @if(!$Urinalyses->other3)
                    @else
                    {{$Urinalyses->other3}}
                    @endif
                </td>
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