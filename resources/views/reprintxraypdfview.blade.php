<!DOCTYPE html>
<html>
<body>
	<table>
		<tbody>
			<tr>
            	<td>
            		<h2><i>X-RAY / ULTRASOUND</i></h2>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 16%;"><b>Name:</b></td>
                        		<td style="width: 50%;">{{$Patientxray->patient->f_name}} {{$Patientxray->patient->m_name}} {{$Patientxray->patient->l_name}}</td>
                                <td style="width: 16%;"><b>O.R. No.:</b></td>
                                <td>{{$receipt_number}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Address:</b></td>
                        		<td style="width: 50%;">{{$Patientxray->patient->address}}</td>
                                <td style="width: 16%;"><b>Sex / Age:</b></td>
                                <td>{{$Patientxray->patient->gender}} / {{$Patientxray->patient->age}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Physician:</b></td>
                        		<td style="width: 50%;">
                                    @if(!$Patientxray->doctor)
                                    @else
                                    {{$Patientxray->doctor->f_name}} {{$Patientxray->doctor->m_name}} {{$Patientxray->doctor->l_name}}, {{$Patientxray->doctor->credential}}
                                    @endif
                                </td>
                                <td style="width: 16%;"><b>Date:</b></td>
                                <td>@foreach($Patientxray->xraydate as $xray){{$xray->date}}@endforeach
                                </td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="width: 50%;">
                    Result / Finding: <b style="font-size: 14pt;">{{$Patientxray->finding}}</b>
                </td>
                <td style="width: 50%;">
                    PLATE: <b>{{$Patientxray->plate}}</b>
                </td>
            </tr>
            <tr><td></td></tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <td style="text-align: justify;">{{$Patientxray->finding_info}}</td>
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