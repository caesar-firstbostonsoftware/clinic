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
                    <h2><i>HEMATOLOGY APTT</i></h2>
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
                <td style="width:19%;">{{$Aptt->or_no}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Address:</td>
                <td style="width:50%;">{{$info->address}}</td>
                <td style="width:11%;">Sex:</td>
                <td style="width:19%;">{{$info->gender}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Physician:</td>
                <td style="width:50%;">{{$Aptt->doctor->f_name}} {{$Aptt->doctor->m_name}} {{$Aptt->doctor->l_name}}, {{$Aptt->doctor->credential}}</td>
                <td style="width:11%;">Date:</td>
                <td style="width:19%;">{{$Aptt->date_reg}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:25%;"><b>CBC</b></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;Hematocrit</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->hematocrit_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> %</td>
                <td style="border: 1px solid black;width:9%;font-size:8pt;"> F42 ± 5<br> M47 ± 7</td>
                <td style="border: 1px solid black;width:30%;"> <b>Clotting(Lee & White)</b><br> Time : <i>{{$Aptt->clottinglw_time}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:6-17 min.</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;Hemoglobin</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->hemoglobin_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> %</td>
                <td style="border: 1px solid black;width:9%;font-size:8pt;"> F14 ± 2</td>
                <td style="border: 1px solid black;width:30%;"> <b>Clotting</b><br> Time : <i>{{$Aptt->clotting_time}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:3-5 min.</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;WBC</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->wbc_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> T/mm</td>
                <td style="border: 1px solid black;width:9%;font-size:8pt;"> 3A5 10<br> CH6 13</td>
                <td style="border: 1px solid black;width:30%;"> <b>Bleeding(Duke Method)</b><br> Time : <i>{{$Aptt->bleedingdm_time}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:1-3 min.</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:25%;"><b>Differential Count %</b></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> BAND<br> 0 - 10</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> PMN<br> 53 - 70</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> BASO<br> 0 - 1</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> EOS<br> 1 - 4</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> MONO<br> 1 - 6</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> LYMPHS<br> 20 - 36</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Aptt->dc_band}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Aptt->dc_pmn}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Aptt->dc_baso}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Aptt->dc_eos}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Aptt->dc_mono}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Aptt->dc_lymph}}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:25%;"></td>
                <td style="width:15%;"></td>
                <td style="width:6%;"></td>
                <td style="width:9%;font-size:8pt;"></td>
                <td style="border: 1px solid black;width:30%;"> <b>Clot</b><br> Retraction : <i>{{$Aptt->clot_retraction}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:48-64%</td>
            </tr>
            <tr>
                <td style="width:25%;"></td>
                <td style="width:15%;"></td>
                <td style="width:6%;"></td>
                <td style="width:9%;font-size:8pt;"></td>
                <td style="border: 1px solid black;width:30%;"> <b>Platelet</b><br> Count : <i>{{$Aptt->platelet_count}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:150-400 <br> T/mm*</td>
            </tr>
            <!-- <tr>
                <td style="width:25%;"></td>
                <td style="width:15%;"></td>
                <td style="width:6%;"></td>
                <td style="width:9%;font-size:8pt;"></td>
                <td style="border: 1px solid black;width:30%;"> <b>ESR (WESTERNGREEN)</b><br> <i>{{$Aptt->esr_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> mm/HR.</td>
            </tr> -->
            <tr>
                <td style="width:25%;"><b>PRO TIME</b></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;Control</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->control_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> sec.</td>
                <td style="border: 1px solid black;width:9%;"> GRP</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->grp_desc}}</i></td>
                <td style="border: 1px solid black;width:20%;"> Rh | <i>{{$Aptt->rh_desc}}</i></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;Patient</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->patient_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> sec.</td>
                <td style="border: 1px solid black;width:9%;">&nbsp;APTT</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->esr_desc}}</i></td>
                <td style="width:20%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;%A</td>
                <td style="border: 1px solid black;width:18%;"> <i>{{$Aptt->a_desc}}</i></td>
                <td style="border: 1px solid black;width:7%;"> INR.</td>
                <td style="border: 1px solid black;width:18%;"> <i>{{$Aptt->inr_desc}}</i></td>
                <td style="width:21%;"></td>
                <td style="width:21%;"></td>
            </tr>
            <tr>
                <td style="width:25%;"><b>CELL INDICES</b></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;MCV</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->mcv_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> 80 - 90</td>
                <td style="border: 1px solid black;width:10%;"> RBC</td>
                <td style="border: 1px solid black;width:20%;"> <i>{{$Aptt->rbc_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;">MIL/mm4</td>
            </tr>
            <tr>
                <td style="width:15%;"></td>
                <td style="width:25%;"></td>
                <td style="width:15%;"></td>
                <td style="width:10%;"></td>
                <td style="width:20%;"> F4-5.5 M4.5-6.0</td>
                <td style="width:15%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;INDICES MCH</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->mch_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> 21 - 31 pg</td>
                <td style="width:10%;"></td>
                <td style="width:20%;"></td>
                <td style="width:15%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;MCHC</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Aptt->mchc_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> 33 - 38 %</td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:50%;">___________________________________________</td>
                <td style="width:50%;"> _____________________________________, RMT</td>
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