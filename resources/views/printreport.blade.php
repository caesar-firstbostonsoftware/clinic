<!DOCTYPE html>
<html lang="en">
<body>

<div>
  	@if($id == 1)
  		<p style="text-align: right;"><b>Income : Php. 100.00</b></p>
  		<table class="table table-striped">
            <thead>
                <tr>
                    <th><b>Physician ID</b></th>
                    <th style="text-align: center;"><b>Physician Name</b></th>
                    <th style="text-align: center;"><b>Patient Count</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            	@foreach($Patientxray as $xray)
                    <tr>
                    	<td>{{$xray->id}}</td>
                        <td style="text-align: center;">{{$xray->f_name}} {{$xray->m_name}} {{$xray->l_name}}, {{$xray->credential}}</td>
                        <td style="text-align: center;">{{$xray->counter}}</td>
                    </tr>
            	@endforeach
            </tbody>
        </table>
  	@else
  		<p><b>Patient Count : {{$counter}}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Income : Php. 100.00</b></p>
  		<table class="table table-striped">
            <thead>
                <tr>
                    <th><b>Patient ID</b></th>
                    <th style="text-align: center;"><b>Patient Name</b></th>
                    <th style="text-align: center;"><b>Date</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            	@foreach($Patientxray as $xray)
                    <tr>
                        <td>{{$xray->patient->id}}</td>
                        <td style="text-align: center;">{{$xray->patient->f_name}} {{$xray->patient->m_name}} {{$xray->patient->l_name}}</td>
                        <td style="text-align: center;">{{$xray->xray_date}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  	@endif
</div>

</body>
</html>