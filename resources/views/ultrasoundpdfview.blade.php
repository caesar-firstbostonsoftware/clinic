<!DOCTYPE html>
<html>
<body>
    @if(!$Patientultrasound->finding)
	<table>
		<tbody>
			<tr>
            	<td>
            		<h2><i>ULTRASOUND</i></h2>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 16%;"><b>Name:</b></td>
                        		<td style="width: 50%;">{{$Patientultrasound->patient->f_name}} {{$Patientultrasound->patient->m_name}} {{$Patientultrasound->patient->l_name}}</td>
                                <td style="width: 16%;"><b>O.R. No.:</b></td>
                                <td>{{$Patientultrasound->or_no}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Address:</b></td>
                        		<td style="width: 50%;">{{$Patientultrasound->patient->address}}</td>
                                <td style="width: 16%;"><b>Sex / Age:</b></td>
                                <td>{{$Patientultrasound->patient->gender}} / {{$Patientultrasound->patient->age}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Physician:</b></td>
                        		<td style="width: 50%;">@if(!$Patientultrasound->doctor)@else{{$Patientultrasound->doctor->f_name}} {{$Patientultrasound->doctor->m_name}} {{$Patientultrasound->doctor->l_name}}, {{$Patientultrasound->doctor->credential}}@endif      
                                </td>
                                <td style="width: 16%;"><b>Date:</b></td>
                                <td>{{$Patientultrasound->ultrasound_date}}</td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    @else
    <table>
        <tbody>
            <tr>
                <td>
                    <h2></h2>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 16%;"></td>
                                <td style="width: 50%;"></td>
                                <td style="width: 16%;"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 16%;"></td>
                                <td style="width: 50%;"></td>
                                <td style="width: 16%;"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 16%;"></td>
                                <td style="width: 50%;"></td>
                                <td style="width: 16%;"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>
    @endif

    <table>
        <tbody>
            <tr>
                <td style="width: 50%;">
                    @if(!$Patientultrasound->finding)
                    @else
                    Result / Finding: <b style="font-size: 14pt;">{{$Patientultrasound->finding}}</b>
                    @endif
                </td>
                <td style="width: 50%;font-size:9pt;">
                    @if(!$Patientultrasound->finding)
                    Service(s): <b>{{$Patientultrasound->ultraservice}}</b>
                    @endif
                </td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="text-align: justify;">{{$Patientultrasound->finding_info}}</td>
            </tr>
            @if(!$Patientultrasound->finding)
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            @endif
        </tbody>
    </table>

    @if(!$Patientultrasound->finding)
    <table>
        <tbody>
            <tr>
                <td style="text-align: center;font-size: 8pt;"><b>SAMUEL S. MARTINEZ, M.D.</b></td>
                <td style="text-align: center;font-size: 8pt;"><b>TERESITO V. ORBETA, M.D.</b></td>
                <td style="text-align: center;font-size: 8pt;"><b>JOSE U. CHIU, M.D.</b></td>
                <td style="text-align: center;font-size: 8pt;"><b>SYLVANO M. ALCANTARA, M.D.</b></td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 8pt;"><i>SONOLOGIST/RADIOLOGIST</i></td>
                <td style="text-align: center;font-size: 8pt;"><i>SONOLOGIST</i></td>
                <td style="text-align: center;font-size: 8pt;"><i>SONOLOGIST/RADIOLOGIST</i></td>
                <td style="text-align: center;font-size: 8pt;"><i>SONOLOGIST/RADIOLOGIST</i></td>
            </tr>
        </tbody>
    </table>
    @endif

</body>
</html>