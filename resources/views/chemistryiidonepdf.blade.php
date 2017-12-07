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
                    <h2><i>Chemistry II</i></h2>
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
                <td style="width:19%;">{{$SecondChemistry->or_no}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Address:</td>
                <td style="width:50%;">{{$info->address}}</td>
                <td style="width:11%;">Sex:</td>
                <td style="width:19%;">{{$info->gender}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Physician:</td>
                <td style="width:50%;">{{$SecondChemistry->doctor->f_name}} {{$SecondChemistry->doctor->m_name}} {{$SecondChemistry->doctor->l_name}}, {{$SecondChemistry->doctor->credential}}</td>
                <td style="width:11%;">Date:</td>
                <td style="width:19%;">{{$SecondChemistry->sec_chem_date}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="border: 1px solid black;width:60%;"></td>
                <td style="border: 1px solid black;text-align:center;width:20%;"><b>Result</b></td>
                <td style="border: 1px solid black;text-align:center;width:20%;"><b>Normal Value</b></td>
            </tr>
            <tr>
                <td style="width:60%;"><b> THYROID PANEL</b></td>
                <td style="width:20%;"></td>
                <td style="width:20%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;TSH(Thyroid-Stimulating Hormone)</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->tsh}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> 0.3 - 4.2 mIU/L</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;T3(Triiodothyronine)</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->t3}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> 1.3 - 3.1 nmd/L</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;T4(Thyroxine)</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->t4}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> 66 - 181 nmd/L</td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="border: 1px solid black;width:60%;"><b> PSA (Protate Specific Antigen)</b></td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;">  {{$SecondChemistry->psa}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> < 4ng/mL</td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="width:60%;"><b> LIVER FUNCTION</b></td>
                <td style="width:20%;"></td>
                <td style="width:20%;"></td>
            </tr>
            <tr>
                <td style="font-size:9pt;width:60%;">&nbsp;&nbsp;Bilirubin</td>
                <td style="font-size:9pt;width:20%;"></td>
                <td style="font-size:9pt;width:20%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- Total</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->bilirubin_total}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> < 1.1 mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- Direct</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->bilirubin_direct}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> < 0.25 mg/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- Indirect</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->bilirubin_indirect}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"></td>
            </tr>
            <tr>
                <td style="font-size:9pt;width:60%;">&nbsp;&nbsp;Serum Protien</td>
                <td style="font-size:9pt;width:20%;"></td>
                <td style="font-size:9pt;width:20%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- Total</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->protien_total}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> < 15.1 - 8.0 g/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- Albumin</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->protien_albumin}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> 3.0 - 5.0 g/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- Globulin</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->protien_globulin}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> 2.5 - 6.0 g/dl</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-size:9pt;width:60%;">&nbsp;&nbsp;-- A/G Ratio</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> {{$SecondChemistry->protien_ag_ratio}}</td>
                <td style="border: 1px solid black;font-size:9pt;width:20%;"> 1.5-3.0 :1.0 g/dl</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:10%;">REMARKS</td>
                <td style="width:90%;"></td>
            </tr>
            <tr><td></td></tr>
        </tbody>
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