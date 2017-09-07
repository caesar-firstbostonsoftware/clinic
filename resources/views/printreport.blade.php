<!DOCTYPE html>
<html lang="en">
<body>

<div>
  	@if($id == 1)
        <p style="text-align: center;"><b>X-Ray Count</b><br><b>From: {{$datefrom}} </b><b> To: {{$dateto}}</b></p>
  		<p style="text-align: right;"><b>Income : Php. <?php echo number_format($income, 2);?></b></p>
  		<table class="table table-striped">
            <thead>
                <tr>
                    <th><b>Physician ID</b></th>
                    <th style="text-align: center;"><b>Physician Name</b></th>
                    <th style="text-align: center;"><b>Patient Count</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            @foreach($Doctor as $docdoc)
            	@foreach($Patientxray as $xray)
                    @if($docdoc->id == $xray->physician_id)
                        <tr>
                    	   <td>{{$docdoc->id}}</td>
                            <td style="text-align: center;">{{$docdoc->f_name}} {{$docdoc->m_name}} {{$docdoc->l_name}}, {{$docdoc->credential}}</td>
                            <td style="text-align: center;">{{$xray->counter}}</td>
                        </tr>
                    @endif
            	@endforeach
            @endforeach
            </tbody>
        </table>
  	@else
  		<p style="text-align: right;"><b>Patient Count : {{$counter}}</b><br><b>Income : Php. <?php echo number_format($income, 2);?></b></p>
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