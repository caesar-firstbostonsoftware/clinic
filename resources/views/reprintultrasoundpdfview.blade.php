<!DOCTYPE html>
<html>
<body>
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
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="width: 50%;">
                    Result / Finding: <b style="font-size: 14pt;">{{$Patientultrasound->finding}}</b>
                </td>
                <td style="width: 50%;font-size:9pt;">
                    Service(s): <b>{{$Patientultrasound->ultraservice}}</b>
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
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>

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

</body>
</html>