<!DOCTYPE html>
<html>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2><i>Chemistry II</i></h2>
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
                <td style="width:24%;">{{$SecondChemistry->sec_chem_date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:50%;"></td>
                <td style="text-align:center;width:25%;"><b style="font-size: 14pt;">Result</b></td>
                <td style="text-align:center;width:25%;"><b style="font-size: 14pt;">Normal Value</b></td>
            </tr>
            @if(!$SecondChemistry->tsh && !$SecondChemistry->t3 && !$SecondChemistry->t4)
            @else
            <tr>
                <td style="width:50%;"><b style="font-size: 14pt;"> THYROID PANEL</b></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
            </tr>
            @if(!$SecondChemistry->tsh)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;TSH(Thyroid-Stimulating Hormone)</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->tsh}}</td>
                <td style="text-align:center;width:25%;"> 0.3 - 4.2 mIU/L</td>
            </tr>
            @endif
            @if(!$SecondChemistry->t3)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;T3(Triiodothyronine)</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->t3}}</td>
                <td style="text-align:center;width:25%;"> 1.3 - 3.1 nmd/L</td>
            </tr>
            @endif
            @if(!$SecondChemistry->t4)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;T4(Thyroxine)</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->t4}}</td>
                <td style="text-align:center;width:25%;"> 66 - 181 nmd/L</td>
            </tr>
            @endif
            @endif

            @if(!$SecondChemistry->psa)
            @else
            <tr>
                <td style="width:50%;"><b style="font-size: 14pt;"> PSA(Protate Specific Antigen)</b></td>
                <td style="text-align:center;width:25%;">  {{$SecondChemistry->psa}}</td>
                <td style="text-align:center;width:25%;"> < 4ng/mL</td>
            </tr>
            @endif

            @if(!$SecondChemistry->bilirubin_total && !$SecondChemistry->bilirubin_direct && !$SecondChemistry->bilirubin_indirect && !$SecondChemistry->protien_total && !$SecondChemistry->protien_albumin && !$SecondChemistry->protien_globulin && !$SecondChemistry->protien_ag_ratio)
            @else
            <tr>
                <td style="width:50%;"><b style="font-size: 14pt;"> LIVER FUNCTION</b></td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
            </tr>
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;Bilirubin</td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
            </tr>
            @if(!$SecondChemistry->bilirubin_total)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- Total</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->bilirubin_total}}</td>
                <td style="text-align:center;width:25%;"> < 1.1 mg/dl</td>
            </tr>
            @endif
            @if(!$SecondChemistry->bilirubin_direct)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- Direct</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->bilirubin_direct}}</td>
                <td style="text-align:center;width:25%;"> < 0.25 mg/dl</td>
            </tr>
            @endif
            @if(!$SecondChemistry->bilirubin_indirect)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- Indirect</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->bilirubin_indirect}}</td>
                <td style="text-align:center;width:25%;"></td>
            </tr>
            @endif
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;Serum Protien</td>
                <td style="width:25%;"></td>
                <td style="width:25%;"></td>
            </tr>
            @if(!$SecondChemistry->protien_total)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- Total</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->protien_total}}</td>
                <td style="text-align:center;width:25%;"> < 15.1 - 8.0 g/dl</td>
            </tr>
            @endif
            @if(!$SecondChemistry->protien_albumin)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- Albumin</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->protien_albumin}}</td>
                <td style="text-align:center;width:25%;"> 3.0 - 5.0 g/dl</td>
            </tr>
            @endif
            @if(!$SecondChemistry->protien_globulin)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- Globulin</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->protien_globulin}}</td>
                <td style="text-align:center;width:25%;"> 2.5 - 6.0 g/dl</td>
            </tr>
            @endif
            @if(!$SecondChemistry->protien_ag_ratio)
            @else
            <tr>
                <td style="width:50%;">&nbsp;&nbsp;-- A/G Ratio</td>
                <td style="text-align:center;width:25%;"> {{$SecondChemistry->protien_ag_ratio}}</td>
                <td style="text-align:center;width:25%;"> 1.5-3.0 :1.0 g/dl</td>
            </tr>
            @endif
            @endif
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:15%;"><b>REMARKS:</b></td>
                <td style="width:85%;">{{$SecondChemistry->remark}}</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$SecondChemistry->user->l_name}} {{$SecondChemistry->user->f_name}} {{$SecondChemistry->user->m_name}}, RMT<br>PRC Number : {{$SecondChemistry->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>