@extends('layouts.frontend.email')
@section('content')
                                <table class="container cta-block" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0" width="400" style="width: 400px;">
                                                <tr>
                                                    <td class="cta-block__title" style="padding: 25px 0; font-size: 26px; text-align: center;">懶人倉租用清單<br>請於結帳前再次確認您的帳單細節.</td>
                                                </tr>

                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>帳號: {{$mailData->account}}</li>
                                                    <li>姓名: {{$mailData->name}}</li>
                                                    <li>電話: {{$mailData->mphone}}</li>
                                                    <li>地址: {{$mailData->address}}</li>
                                                    <!--<li>推薦碼: {{$mailData->mgmFlag}}</li>-->
                                                    <li>備註: {{$mailData->note}}</li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>項目</li>
                                                    @foreach($mailData->items as $item)
                                                    <li>{{$item['num']}}: {{$item['point']}}</li>
                                                    @endforeach
                                                    <li>月費總計: {{$mailData->monthlyTotalPoint}}</li>
                                                    <li>上樓搬運費: {{$mailData->floorFee}}</li>
                                                    <li>運費: {{$mailData->transferFee}}</li>
                                                    <li>總結: {{$mailData->summary}}</li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                
                                                    <li>派送空箱</li>
                                                    @if(!empty($mailData->scheduleNewBoxDate))
                                                            <li>日期: {{$mailData->scheduleNewBoxDate}}. 星期{{$mailData->scheduleNewBoxWeek}}</li>
                                                            <li>時間: {{$mailData->scheduleNewBoxTime}}</li>

                                                    <!--<li>預約取件</li>
                                                    <li>日期: {{$mailData->schedulePickupDate}}. 星期{{$mailData->schedulePickupWeek}}</li>
                                                    <li>時間: {{$mailData->schedulePickupTime}}</li>-->
                                                        @endif
                                                    </ul>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="cta-block__title" style="padding: 25px 0; font-size: 26px; text-align: center;">請於二週內預約取件，起租日由本公司收回收納箱隔日或派送空箱後第15天起算，以較早日期計算。</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        @include('emails.includes.footer')
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
@endsection