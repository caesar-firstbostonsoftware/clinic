<!DOCTYPE html>
<html>
<style type="text/css">
	td{
		font-size: 10pt;
	}
</style>
<body>
	<table>
		<tbody>

			<tr>
            	<td>
            		<h2><i>URINALYSIS</i></h2>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 16%;"><b>Name:</b></td>
                        		<td style="width: 50%;">{{$Urinalyses->patient->f_name}} {{$Urinalyses->patient->m_name}} {{$Urinalyses->patient->l_name}}</td>
                                <td style="width: 16%;"><b>O.R. No.:</b></td>
                                <td>{{$Urinalyses->or_no}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Address:</b></td>
                        		<td style="width: 50%;">{{$Urinalyses->patient->address}}</td>
                                <td style="width: 16%;"><b>Sex:</b></td>
                                <td>{{$Urinalyses->patient->gender}}</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 16%;"><b>Physician:</b></td>
                        		<td style="width: 50%;">{{$Urinalyses->phy->f_name}} {{$Urinalyses->phy->m_name}} {{$Urinalyses->phy->l_name}}, {{$Urinalyses->phy->credential}}</td>
                                <td style="width: 16%;"><b>Date:</b></td>
                                <td>{{$Urinalyses->date}}</td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>

            <tr>
                <td>
                    <table>
                        <tbody>
                        <hr>
                            <tr><td></td></tr>
                            <tr>
                                <td style="width: 20%;"><b>PHYSICAL:</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        {{$Urinalyses->physical}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Color:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->color)
                                            N / A
                                        @else
                                            {{$Urinalyses->color}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Transparency:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->transparency)
                                            N / A
                                        @else
                                            {{$Urinalyses->transparency}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Specific Gravity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->specific_gravity)
                                            N / A
                                        @else
                                            {{$Urinalyses->specific_gravity}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <hr>
                            <tr><td></td></tr>

                            <tr>
                                <td style="width: 20%;"><b>CHEMICAL:</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        {{$Urinalyses->chemical}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Glucose:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->glucose)
                                            N / A
                                        @else
                                            {{$Urinalyses->glucose}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Bilirubin:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->bilirubin)
                                            N / A
                                        @else
                                            {{$Urinalyses->bilirubin}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Ketone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->ketone)
                                            N / A
                                        @else
                                            {{$Urinalyses->ketone}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Blood:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->blood)
                                            N / A
                                        @else
                                            {{$Urinalyses->blood}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>pH:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->ph)
                                            N / A
                                        @else
                                            {{$Urinalyses->ph}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Protein:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->protein)
                                            N / A
                                        @else
                                            {{$Urinalyses->protein}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Urobilinogen:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->urobilinogen)
                                            N / A
                                        @else
                                            {{$Urinalyses->urobilinogen}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Leucocytes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->leucocytes)
                                            N / A
                                        @else
                                            {{$Urinalyses->leucocytes}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Nitrities:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->nitrites)
                                            N / A
                                        @else
                                            {{$Urinalyses->nitrites}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <hr>
                            <tr><td></td></tr>
                        
                            <tr>
                                <td style="width: 20%;"><b>MICROSCOPIC:</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        {{$Urinalyses->microscopic}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>WBC:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->wbc)
                                            N / A
                                        @else
                                            {{$Urinalyses->wbc}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>RBC:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->rbc)
                                            N / A
                                        @else
                                            {{$Urinalyses->rbc}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Epith. Cells:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->epith_cell)
                                            N / A
                                        @else
                                            {{$Urinalyses->epith_cell}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Bacteria:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->bacteria)
                                            N / A
                                        @else
                                            {{$Urinalyses->bacteria}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Cast(s):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->cast)
                                            N / A
                                        @else
                                            {{$Urinalyses->cast}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->cast2)
                                            N / A
                                        @else
                                            {{$Urinalyses->cast2}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Crystal(s):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->crystal)
                                            N / A
                                        @else
                                            {{$Urinalyses->crystal}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->crystal2)
                                            N / A
                                        @else
                                            {{$Urinalyses->crystal2}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Amorphous Materials:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->amorphous_material)
                                            N / A
                                        @else
                                            {{$Urinalyses->amorphous_material}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Mucus Thread:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->mucus_thread)
                                            N / A
                                        @else
                                            {{$Urinalyses->mucus_thread}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>Others:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->other)
                                            N / A
                                        @else
                                            {{$Urinalyses->other}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->other2)
                                            N / A
                                        @else
                                            {{$Urinalyses->other2}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->other3)
                                            N / A
                                        @else
                                            {{$Urinalyses->other3}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <hr>
                            <tr><td></td></tr>

                            <tr>
                                <td style="width: 20%;"><b>PREGNACY TEST:</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        {{$Urinalyses->pregnancy_test}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;text-align: right;"><b>REMARKS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                <td>
                                    @if(!$Urinalyses)
                                        N / A
                                    @else
                                        @if(!$Urinalyses->preg_remark)
                                            N / A
                                        @else
                                            {{$Urinalyses->preg_remark}}
                                        @endif
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>

            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
                <td><b style="font-size: 14pt;">_______________________</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 14pt;">_______________________</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Pathologist</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>RMT</i></td>
            </tr>

		</tbody>
	</table>

</body>
</html>