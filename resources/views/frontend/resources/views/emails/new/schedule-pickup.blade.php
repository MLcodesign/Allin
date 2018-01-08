@extends('layouts.frontend.email')
@section('content')
                                <table class="container cta-block" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0" width="400" style="width: 400px;">
                                                <tr>
                                                    <td class="cta-block__title" style="padding: 25px 0; font-size: 26px; text-align: center;">{{$mailData->subject}}</td>
                                                </tr>

                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>帳號: {{$mailData->account}}</li>
                                                    <li>姓名: {{$mailData->name}}</li>
                                                    <li>電話: {{$mailData->mphone}}</li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>預約日期: {{$mailData->shipDate}}. 星期{{$mailData->shipWeek}}</li>
                                                    <li>預約時間: {{$mailData->shipTime}}</li>
                                                    <li>預約數量: {{$mailData->quantity}}</li>
                                                    <li>地址: {{$mailData->address}}</li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>我的箱子</li>
                                                    @foreach($mailData->boxesData as $box)
                                                    <li><div>
                                                    <p>{{$box["adminId"]}}</p>
                                                    <p>{{$box["name"]}}<br>
                                                    {!!$box["pic"]!!}</p>
                                                    </div></li>
                                                    @endforeach
                                                    </ul>
                                                    </td>
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