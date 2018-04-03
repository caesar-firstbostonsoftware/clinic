<!DOCTYPE html>
<html>
<body>
    <table cellpadding="-2">
        <tbody>
            <tr><td></td></tr>
            <tr>
                <td style="width:45%;"><h2><i>HEMATOLOGY</i></h2></td>
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
                <td style="width:24%;">{{$Hematology->date_reg}}</td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    @if(!$Hematology->hematocrit_desc && !$Hematology->hemoglobin_desc && !$Hematology->wbc_desc)
    @else
    <table cellpadding="-2">
        <tbody>
            <tr>
                <td style="width:50%;"><b style="font-size: 12pt;">CBC</b></td>
            </tr>
            @if(!$Hematology->hematocrit_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;Hematocrit</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->hematocrit_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;">%</td>
                <td style="width:25%;text-align: center;font-size: 7pt;">F42 ± 5<br> M47 ± 7</td>
            </tr>
            @endif
            @if(!$Hematology->hemoglobin_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;Hemoglobin</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->hemoglobin_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;">%</td>
                <td style="width:25%;text-align: center;font-size: 7pt;">F14 ± 2</td>
            </tr>
            @endif
            @if(!$Hematology->wbc_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;WBC</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->wbc_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;">T/mm</td>
                <td style="width:25%;text-align: center;font-size: 7pt;">3A5 10<br> CH6 13</td>
            </tr>
            @endif
        </tbody>
    </table>
    @endif

    @if(!$Hematology->dc_band && !$Hematology->dc_pmn && !$Hematology->dc_baso && !$Hematology->dc_eos && !$Hematology->dc_mono && !$Hematology->dc_lymph)
    @else
    <table cellpadding="-1">
        <tbody>
            <tr>
                <td style="width:50%;"><b style="font-size: 12pt;">Differential Count %</b></td>
            </tr>
            <tr>
                <td style="width:5%;"></td>
                @if(!$Hematology->dc_band)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;font-size: 7pt;"> BAND<br> 0 - 10</td>
                @endif
                @if(!$Hematology->dc_pmn)
                @else
                <td style="border: 1px solid black;width:12%;text-align: center;font-size: 7pt;"> PMN<br> 53 - 70</td>
                @endif
                @if(!$Hematology->dc_baso)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;font-size: 7pt;"> BASO<br> 0 - 1</td>
                @endif
                @if(!$Hematology->dc_eos)
                @else
                <td style="border: 1px solid black;width:12%;text-align: center;font-size: 7pt;"> EOS<br> 1 - 4</td>
                @endif
                @if(!$Hematology->dc_mono)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;font-size: 7pt;"> MONO<br> 1 - 6</td>
                @endif
                @if(!$Hematology->dc_lymph)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;font-size: 7pt;"> LYMPHS<br> 20 - 36</td>
                @endif
            </tr>
            <tr>
                <td style="width:5%;"></td>
                @if(!$Hematology->dc_band)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;"> <b>{{$Hematology->dc_band}}</b></td>
                @endif
                @if(!$Hematology->dc_pmn)
                @else
                <td style="border: 1px solid black;width:12%;text-align: center;"> <b>{{$Hematology->dc_pmn}}</b></td>
                @endif
                @if(!$Hematology->dc_baso)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;"> <b>{{$Hematology->dc_baso}}</b></td>
                @endif
                @if(!$Hematology->dc_eos)
                @else
                <td style="border: 1px solid black;width:12%;text-align: center;"> <b>{{$Hematology->dc_eos}}</b></td>
                @endif
                @if(!$Hematology->dc_mono)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;"> <b>{{$Hematology->dc_mono}}</b></td>
                @endif
                @if(!$Hematology->dc_lymph)
                @else
                <td style="border: 1px solid black;width:13%;text-align: center;"> <b>{{$Hematology->dc_lymph}}</b></td>
                @endif
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    @endif

    @if(!$Hematology->platelet_count && !$Hematology->rbc_desc)
    @else
    <table cellpadding="-2">
        <tbody>
            @if(!$Hematology->platelet_count)
            @else
            <tr>
                <td style="width:25%;"><b style="font-size: 12pt;">Platelet</b> Count :</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->platelet_count}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;">T/mm*</td>
                <td style="width:25%;text-align: center;font-size: 7pt;">N:150-400</td>
            </tr>
            @endif
            @if(!$Hematology->rbc_desc)
            @else
            <tr>
                <td style="width:25%;"><b style="font-size: 12pt;">RBC</b></td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->rbc_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;">MIL/mm4</td>
                <td style="width:25%;text-align: center;font-size: 7pt;">F4-5.5 M4.5-6.0</td>
            </tr>
            @endif
        </tbody>
    </table>
    @endif

    @if(!$Hematology->control_desc && !$Hematology->patient_desc && !$Hematology->a_desc && !$Hematology->mcv_desc && !$Hematology->mch_desc && !$Hematology->mchc_desc)
    @else
    <table cellpadding="-2">
        <tbody>
            @if(!$Hematology->mcv_desc && !$Hematology->mch_desc && !$Hematology->mchc_desc)
            @else
            <tr>
                <td style="width:50%;"><b style="font-size: 12pt;">CELL INDICES</b></td>
            </tr>
            @if(!$Hematology->mcv_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;MCV</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->mcv_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;"></td>
                <td style="width:25%;text-align: center;font-size: 7pt;"> 80 - 90</td>
            </tr>
            @endif
            @if(!$Hematology->mch_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;INDICES MCH</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->mch_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;"></td>
                <td style="width:25%;text-align: center;font-size: 7pt;"> 21 - 31 pg</td>
            </tr>
            @endif
            @if(!$Hematology->mchc_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;MCHC</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->mchc_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;"></td>
                <td style="width:25%;text-align: center;font-size: 7pt;"> 33 - 38 %</td>
            </tr>
            @endif
            @endif
            @if(!$Hematology->control_desc && !$Hematology->patient_desc && !$Hematology->a_desc)
            @else
            <tr>
                <td style="width:50%;"><b style="font-size: 12pt;">PRO TIME</b></td>
            </tr>
            @if(!$Hematology->control_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;Control</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->control_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;"> sec.</td>
            </tr>
            @endif
            @if(!$Hematology->patient_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;Patient</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->patient_desc}}</b></i></td>
                <td style="width:6%;text-align: center;font-size: 7pt;"> sec.</td>
            </tr>
            @endif
            @if(!$Hematology->a_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;%A</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->a_desc}}</b></i></td>
            </tr>
            @endif
            @if(!$Hematology->inr_desc)
            @else
            <tr>
                <td style="width:5%;"></td>
                <td style="width:20%;">&nbsp;INR.</td>
                <td style="width:25%;text-align: center;"> <i><b>{{$Hematology->inr_desc}}</b></i></td>
            </tr>
            @endif
            @endif
        </tbody>
    </table>
    @endif

    @if(!$Hematology->clottinglw_time && !$Hematology->clotting_time && !$Hematology->bleedingdm_time && !$Hematology->grp_desc && !$Hematology->rh_desc)
    @else
    <table cellpadding="-2">
        <tbody>
            <tr><td></td></tr>
            @if(!$Hematology->clottinglw_time)
            @else
            <tr>
                <td style="width:56%;"> <b>Clotting(Lee & White)</b> Time : <i><b>{{$Hematology->clottinglw_time}}</b></i></td>
                <td style="width:25%;text-align: center;font-size: 7pt;"> N:6-17 min.</td>
            </tr>
            @endif
            @if(!$Hematology->clotting_time)
            @else
            <tr>
                <td style="width:56%;"> <b>Clotting</b> Time : <i><b>{{$Hematology->clotting_time}}</b></i></td>
                <td style="width:25%;text-align: center;font-size: 7pt;"> N:3-5 min.</td>
            </tr>
            @endif
            @if(!$Hematology->bleedingdm_time)
            @else
            <tr>
                <td style="width:56%;"> <b>Bleeding(Duke Method)</b> Time : <i><b>{{$Hematology->bleedingdm_time}}</b></i></td>
                <td style="width:25%;text-align: center;font-size: 7pt;"> N:1-3 min.</td>
            </tr>
            @endif
            <tr><td></td></tr>
            @if(!$Hematology->grp_desc)
            @else
            <tr>
                <td style="width:50%;"> <b>GRP : </b> <i><b>{{$Hematology->grp_desc}}</b></i></td>
            </tr>
            @endif
            @if(!$Hematology->rh_desc)
            @else
            <tr>
                <td style="width:50%;"> <b>Rh. : </b> <i><b>{{$Hematology->rh_desc}}</b></i></td>
            </tr>
            @endif
        </tbody>
    </table>
    @endif

    <table cellpadding="-2">
        <tbody>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table cellpadding="-2">
        <tbody>
            <tr>
                <td style="width:50%;text-align: center;"><b style="font-size: 12pt;">ROGELIO S. McNTIRE, M.D.,FPSP</b><br>Pathologist</td>
                <td style="width:50%;text-align: center;"> {{$Hematology->user->l_name}} {{$Hematology->user->f_name}} {{$Hematology->user->m_name}}, RMT<br>PRC Number : {{$Hematology->user->license_number}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>