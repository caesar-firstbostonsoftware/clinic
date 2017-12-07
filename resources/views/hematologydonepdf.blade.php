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
                    <h2><i>HEMATOLOGY</i></h2>
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
                <td style="width:19%;">{{$Hematology->or_no}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Address:</td>
                <td style="width:50%;">{{$info->address}}</td>
                <td style="width:11%;">Sex:</td>
                <td style="width:19%;">{{$info->gender}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Physician:</td>
                <td style="width:50%;">{{$Hematology->doctor->f_name}} {{$Hematology->doctor->m_name}} {{$Hematology->doctor->l_name}}, {{$Hematology->doctor->credential}}</td>
                <td style="width:11%;">Date:</td>
                <td style="width:19%;">{{$Hematology->date_reg}}</td>
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
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->hematocrit_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> %</td>
                <td style="border: 1px solid black;width:9%;font-size:8pt;"> F42 ± 5<br> M47 ± 7</td>
                <td style="border: 1px solid black;width:30%;"> <b>Clotting(Lee & White)</b><br> Time : <i>{{$Hematology->clottinglw_time}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:6-17 min.</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;Hemoglobin</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->hemoglobin_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> %</td>
                <td style="border: 1px solid black;width:9%;font-size:8pt;"> F14 ± 2</td>
                <td style="border: 1px solid black;width:30%;"> <b>Clotting</b><br> Time : <i>{{$Hematology->clotting_time}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:3-5 min.</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;WBC</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->wbc_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> T/mm</td>
                <td style="border: 1px solid black;width:9%;font-size:8pt;"> 3A5 10<br> CH6 13</td>
                <td style="border: 1px solid black;width:30%;"> <b>Bleeding(Duke Method)</b><br> Time : <i>{{$Hematology->bleedingdm_time}}</i></td>
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
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Hematology->dc_band}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Hematology->dc_pmn}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Hematology->dc_baso}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Hematology->dc_eos}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Hematology->dc_mono}}</td>
                <td style="border: 1px solid black;width:8%;font-size:8pt;"> {{$Hematology->dc_lymph}}</td>
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
                <td style="border: 1px solid black;width:30%;"> <b>Clot</b><br> Retraction : <i>{{$Hematology->clot_retraction}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:48-64%</td>
            </tr>
            <tr>
                <td style="width:25%;"></td>
                <td style="width:15%;"></td>
                <td style="width:6%;"></td>
                <td style="width:9%;font-size:8pt;"></td>
                <td style="border: 1px solid black;width:30%;"> <b>Platelet</b><br> Count : <i>{{$Hematology->platelet_count}}</i></td>
                <td style="border: 1px solid black;width:15%;"> N:150-400 <br> T/mm*</td>
            </tr>
            <tr>
                <td style="width:25%;"></td>
                <td style="width:15%;"></td>
                <td style="width:6%;"></td>
                <td style="width:9%;font-size:8pt;"></td>
                <td style="border: 1px solid black;width:30%;"> <b>ESR (WESTERNGREEN)</b><br> <i>{{$Hematology->esr_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> mm/HR.</td>
            </tr>
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
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->control_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> sec.</td>
                <td style="border: 1px solid black;width:9%;"> GRP</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->grp_desc}}</i></td>
                <td style="border: 1px solid black;width:20%;"> Rh | <i>{{$Hematology->rh_desc}}</i></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;Patient</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->patient_desc}}</i></td>
                <td style="border: 1px solid black;width:6%;"> sec.</td>
                <td style="border: 1px solid black;width:9%;"> SMP</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->smp_desc}}</i></td>
                <td style="width:20%;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;%A</td>
                <td style="border: 1px solid black;width:31%;"> <i>{{$Hematology->a_desc}}</i></td>
                <td style="border: 1px solid black;width:9%;"> INR.</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->inr_desc}}</i></td>
                <td style="width:10%;"></td>
                <td style="width:10%;"></td>
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
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->mcv_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> 80 - 90</td>
                <td style="border: 1px solid black;width:10%;"> RETIC</td>
                <td style="border: 1px solid black;width:20%;"> <i>{{$Hematology->retic_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> %0.5 - 1.5</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:15%;">&nbsp;INDICES MCH</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->mch_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> 21 - 31 pg</td>
                <td style="border: 1px solid black;width:10%;"> RBC</td>
                <td style="border: 1px solid black;width:20%;"> <i>{{$Hematology->rbc_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> MIL/mm4</td>
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
                <td style="border: 1px solid black;width:15%;">&nbsp;MCHC</td>
                <td style="border: 1px solid black;width:25%;"> <i>{{$Hematology->mchc_desc}}</i></td>
                <td style="border: 1px solid black;width:15%;"> 33 - 38 %</td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>
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