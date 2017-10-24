@extends('layouts.frontend.email')
@section('content')
                                <table class="container cta-block" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0" width="400" style="width: 400px;">
                                                <tr>
                                                    <td class="cta-block__title" style="padding: 25px 0; font-size: 26px; text-align: center;">派送物品下單成功通知</td>
                                                </tr>

                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>帳號: xxx＠gmail.com</li>
                                                    <li>姓名: 王小明</li>
                                                    <li>電話: 0966888888</li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cta-block__content" style="padding: 10px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: left;">
                                                    <ul>
                                                    <li>預約日期: 2016年10月10日. 星期一</li>
                                                    <li>預約時間: 上午 9:00-12:00</li>
                                                    <li>預約數量: 3</li>
                                                    <li>地址: 台北市信義區信義路688號</li>
                                                    <li>上樓搬運費: (有or無)</li>
                                                    <li>備註: 請上樓打手機</li>
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