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
                                <td>{{$Patientxray->or_no}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Address:</b></td>
                        		<td style="width: 50%;">{{$Patientxray->patient->address}}</td>
                                <td style="width: 16%;"><b>Sex:</b></td>
                                <td>{{$Patientxray->patient->gender}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Physician:</b></td>
                        		<td style="width: 50%;">{{$Patientxray->doctor->f_name}} {{$Patientxray->doctor->m_name}} {{$Patientxray->doctor->l_name}}, {{$Patientxray->doctor->credential}}</td>
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

            <tr>
                <td>
                    <h4><i>Result / Finding : </i> <b style="font-size: 14pt;">{{$Patientxray->finding}}</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PLATE: <b style="font-size: 10pt;">{{$Patientxray->plate}}</b></h4>
                </td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="text-align: justify;">{{$Patientxray->finding_info}}</td>
            </tr>

            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
                <td><b style="font-size: 14pt;">{{$Patientxray->doctor->f_name}} {{$Patientxray->doctor->m_name}} {{$Patientxray->doctor->l_name}}, {{$Patientxray->doctor->credential}}</b><br><i>{{$Patientxray->doctor->specialization}}</i></td>
            </tr>

		</tbody>
	</table>

</body>
</html>