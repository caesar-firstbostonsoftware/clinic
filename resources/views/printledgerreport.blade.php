<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    td {
        font-size: 8pt;
    }
    p {
        font-size: 8pt;
    }
</style>
@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show
<body>

<div style="text-align: left;">
    <img src="{{ asset('/img/nfhsi_logo.png') }}" style="width: 15%;height: 10%;">
</div>
<div style="margin-left: 15%;margin-top: -15%;">
    <p><b>NEGROS FAMILY HEALTH SERVICES, INC.</b></p>
    <p><b>NORTH ROAD, DARO (IN FRONT OF NOPH), DUMAGUETE CITY, NEGROS ORIENTAL</b></p>
    <p><b>TEL No. (035)225-3544</b></p>
</div>
<br><br>
<div>
        <p style="text-align: center;"><b>Ledger Report</b><br><b>From: {{$datefrom}} </b><b> To: {{$dateto}}</b></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:9%;font-size:8pt;">Date</th>
                    <th style="width:9%;font-size:8pt;">OR No.</th>
                    <th style="width:40%;font-size:8pt;">Service(s)</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">Laboratory</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">Ultrasound</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">Xray</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">ECG</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">Amount</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">Discount</th>
                    <th style="text-align: right;width:6%;font-size:8pt;">Total</th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
                <?php $total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0; $total7 = 0; ?>
            @foreach($PatientVisit as $PV)
                <tr>
                    <td style="text-align: center;width:9%;">{{$PV->visit_date}}</td>
                    <td style="text-align: center;width:9%;">@if(!$PV->receipt)@else{{$PV->receipt->receipt_number}}@endif</td>
                    <td style="width:40%;">
                        <?php $sum1 = 0; $sum2 = 0; $sum3 = 0; $sum4 = 0;?>
                        @foreach($PV->service as $serser)
                            @if($PV->visitid == $serser->visit_id)
                                @foreach($AdminPanel as $adad)
                                    @if($serser->admin_panel_sub_id == $adad->id)
                                        {{$adad->name}},

                                        @if($adad->type == 'Package')

                                            @foreach($adad->package as $pacpac)
                                                @if ($pacpac->main_id == 1 || $pacpac->main_id == 2 || $pacpac->main_id == 3 || $pacpac->main_id == 4 || $pacpac->main_id == 7 || $pacpac->main_id == 8 || $pacpac->main_id == 9 || $pacpac->main_id == 10 )
                                                    @if($pacpac->service_id == 92)
                                                    @else
                                                        <?php $sum1 += floatval($pacpac->price); ?>
                                                    @endif
                                                @endif
                                                @if ($pacpac->main_id == 6)
                                                    <?php $sum2 += floatval($pacpac->price); ?>
                                                @endif
                                                @if ($pacpac->main_id == 5)
                                                    <?php $sum3 += floatval($pacpac->price); ?>
                                                @endif
                                                @if ($pacpac->service_id == 92)
                                                    <?php $sum4 += floatval($pacpac->price); ?>
                                                @endif
                                            @endforeach

                                        @else

                                            @if ($serser->admin_panel_id == 1 || $serser->admin_panel_id == 2 || $serser->admin_panel_id == 3 || $serser->admin_panel_id == 4 || $serser->admin_panel_id == 7 || $serser->admin_panel_id == 8 || $serser->admin_panel_id == 9 || $serser->admin_panel_id == 10 )
                                                @if($serser->admin_panel_sub_id == 92)
                                                @else
                                                    <?php $sum1 += floatval($adad->price); ?>
                                                @endif
                                            @endif
                                            @if ($serser->admin_panel_id == 6)
                                                <?php $sum2 += floatval($adad->price); ?>
                                            @endif
                                            @if ($serser->admin_panel_id == 5)
                                                <?php $sum3 += floatval($adad->price); ?>
                                            @endif
                                            @if ($serser->admin_panel_sub_id == 92)
                                                <?php $sum4 += floatval($adad->price); ?>
                                            @endif

                                        @endif

                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </td>
                    <td style="text-align: right;width:6%;">{{number_format($sum1, 2)}}</td>
                    <td style="text-align: right;width:6%;">{{number_format($sum2, 2)}}</td>
                    <td style="text-align: right;width:6%;">{{number_format($sum3, 2)}}</td>
                    <td style="text-align: right;width:6%;">{{number_format($sum4, 2)}}</td>
                    <td style="text-align: right;width:6%;">{{number_format($PV->totalbill, 2)}}</td>
                    <td style="text-align: right;width:6%;">{{number_format($PV->discounted_price, 2)}}</td>
                    <td style="text-align: right;width:6%;">{{number_format($PV->discounted_total, 2)}}</td>
                    <?php $total1 += floatval($sum1); ?>
                    <?php $total2 += floatval($sum2); ?>
                    <?php $total3 += floatval($sum3); ?>
                    <?php $total4 += floatval($sum4); ?>
                    <?php $total5 += floatval($PV->totalbill); ?>
                    <?php $total6 += floatval($PV->discounted_price); ?>
                    <?php $total7 += floatval($PV->discounted_total); ?>
                </tr>
            @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;"><b>TOTAL (Php)</b></td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total1, 2)}}</td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total2, 2)}}</td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total3, 2)}}</td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total4, 2)}}</td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total5, 2)}}</td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total6, 2)}}</td>
                    <td style="text-align: right;color:red;font-weight: bold;">{{number_format($total7, 2)}}</td>
                </tr>
            </tbody>
        </table>

</div>

</body>
</html>