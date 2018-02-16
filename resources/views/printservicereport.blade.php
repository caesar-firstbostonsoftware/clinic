<!DOCTYPE html>
<html lang="en">
<body>

<div>
        <p style="text-align: center;"><b>Service Report</b><br><b>From: {{$datefrom}} </b><b> To: {{$dateto}}</b></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;"><b>Service Description</b></th>
                    <th style="text-align: center;"><b>Patient Count</b></th>
                    <th style="text-align: center;"><b>Date</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            @foreach($Patientxray as $xraycount)
                <tr>
                    <td style="text-align: center;">{{$xraycount->service_name}}</td>
                    <td style="text-align: center;">{{$xraycount->counter}}</td>
                    <td style="text-align: center;">{{$xraycount->date_reg}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

</div>

</body>
</html>