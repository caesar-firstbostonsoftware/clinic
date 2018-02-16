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
                                <td style="width: 16%;"><b>Sex:</b></td>
                                <td>{{$Patientultrasound->patient->gender}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Physician:</b></td>
                        		<td style="width: 50%;">{{$Patientultrasound->doctor->f_name}} {{$Patientultrasound->doctor->m_name}} {{$Patientultrasound->doctor->l_name}}, {{$Patientultrasound->doctor->credential}}</td>
                                <td style="width: 16%;"><b>Date:</b></td>
                                <td>{{$Patientultrasound->ultrasound_date}}</td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>

            <tr>
                <td>
                    <h4><i>Result / Finding : </i> <b style="font-size: 14pt;">{{$Patientultrasound->finding}}</b></h4>
                </td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td style="text-align: justify;">{{$Patientultrasound->finding_info}}</td>
            </tr>

            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
                <td><b style="font-size: 14pt;">{{$Patientultrasound->doctor->f_name}} {{$Patientultrasound->doctor->m_name}} {{$Patientultrasound->doctor->l_name}}, {{$Patientultrasound->doctor->credential}}</b><br><i>{{$Patientultrasound->doctor->specialization}}</i></td>
            </tr>

		</tbody>
	</table>

</body>
</html>