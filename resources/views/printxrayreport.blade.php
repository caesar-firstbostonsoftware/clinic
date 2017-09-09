<!DOCTYPE html>
<html lang="en">
<body>

<div>
        <p style="text-align: center;"><b>X-Ray Count</b><br><b>From: {{$datefrom}} </b><b> To: {{$dateto}}</b></p>
        <?php 
            $amount = 0;
            foreach($Patientxray as $key) {
                $amount += $key->counter;
            }
            $income = $amount * $xrayprice->price;
        ?>
        <p style="text-align: right;"><b>Income : Php. <?php echo number_format($income, 2);?></b></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    @if($id == 1)
                    <th style="text-align: center;"><b>Physician Name</b></th>
                    @else
                    <th style="text-align: center;"><b>Date</b></th>
                    @endif
                    <th style="text-align: center;"><b>Patient Count</b></th>
                    <th style="text-align: center;"><b>Amount</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            @if($id == 1)
            @foreach($Doctor as $docdoc)
                @foreach($Patientxray as $xray)
                    @if($docdoc->id == $xray->physician_id)
                    <?php $aaamount = $xray->counter * $xrayprice->price; ?>
                        <tr>
                            <td style="text-align: center;">{{$docdoc->f_name}} {{$docdoc->m_name}} {{$docdoc->l_name}}, {{$docdoc->credential}}</td>
                            <td style="text-align: center;">{{$xray->counter}}</td>
                            <td style="text-align: center;">{{$aaamount}}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            @else
                @foreach($Patientxray as $xray)
                    <?php $aaamount = $xray->counter * $xrayprice->price; ?>
                        <tr>
                            <td style="text-align: center;">{{$xray->xray_date}}</td>
                            <td style="text-align: center;">{{$xray->counter}}</td>
                            <td style="text-align: center;">{{$aaamount}}</td>
                        </tr>
                @endforeach
            @endif
            </tbody>
        </table>

</div>

</body>
</html>