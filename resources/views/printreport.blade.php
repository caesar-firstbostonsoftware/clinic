<!DOCTYPE html>
<html lang="en">
<body>

<div>
        <p style="text-align: center;"><b>Income</b><br><b>From: {{$datefrom}} </b><b> To: {{$dateto}}</b></p>
  		<p style="text-align: right;"><b>Income : Php. <?php echo number_format($income, 2);?></b></p>
  		<table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;"><b>Date</b></th>
                    <th style="text-align: center;"><b>Patient Count</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            
            	@foreach($Patientxray as $xray)
                    
                        <tr>
                            <td style="text-align: center;">{{$xray->visit_date}}</td>
                            <td style="text-align: center;">{{$xray->counter}}</td>
                        </tr>
                
            	@endforeach
           
            </tbody>
        </table>

</div>

</body>
</html>