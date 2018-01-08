@extends('layouts.frontend.single')

@section('title', '來收箱子內容確認')

@section('css')

    {!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}

    <style>
        label{
            display: block !important;
            position: relative;
            -webkit-transform: translateY(0);
            transform: translateY(0);
            left: 0;
            color: #333;
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
            -webkit-backface-visibility: hidden;
            pointer-events: none;
            font-size: 14px;
        }
        label.active {
            -webkit-transform: translateY(0px);
            transform: translateY(0px);
            left: 0px;
        }
        label.active .req{
            opacity: 1;
        }
        .error{
            color: red;
            font-size: 15px;
            font-weight: 600;
        }
    </style>

@endsection

@section('content')    
    <form action="{!! URL::to('schedule-pickup/checkout') !!}" method="post" id="submit-form">
        {!! csrf_field() !!}

        <input type="hidden" name="address" value="{{$pageData->address}}">
        <input type="hidden" name="country" value="{{$pageData->country}}">
        <input type="hidden" name="district" value="{{$pageData->district}}">
        <input type="hidden" name="zipcode" value="{{$pageData->zipcode}}">
        <input type="hidden" name="phone" value="{{$pageData->phone}}">
        <input type="hidden" name="pickup_date" value="{{$pageData->pickupDate}}">
        <input type="hidden" name="pickup_time" value="{{$pageData->pickupTime}}">
        <input type="hidden" name="quantity" value="{{$pageData->pickupNum}}">
        <input type="hidden" name="special_instruction" value="{{$pageData->specialInstruction}}">
        

    </form>

    <section id="review">
        <div class="container">
        
        
        
        
        <br><br><br><br>
        
            <div class="row">
                
              <div class="col-md-12 text-center" style="padding-bottom:12px;">
       <h1><b><font><font class="">訂單總覽</font></font></b></h1>
       <p class="y_line"></p>
    </div>
              
              
        <div class="col-md-12 text-center">
        
            <div class="preview-block">
                                
                            <div id="pickup" class="preview-block last">
                                <div class="block-middle">
                                    <div class="block-title">地址</div>
                                    <div class="block-content">
                                        <div class="block-content-row" id="dAddress1">{{$pageData->country}} {{$pageData->district}} {{$pageData->zipcode}}</div>
                                        <div class="block-content-row" id="dAddress1">{{$pageData->address}}</div>
                                        <div class="block-content-row" id="dPhone">{{$pageData->phone}}</div>
                                        <div class="block-content-row" id="dPhone">{{$pageData->specialInstruction }} </div>
                                    </div>
                                </div>
                                <div class="block-right">
                                    <div class="block-button"></div>
                                </div>

                            </div>
                    
                            <div id="pickup" class="preview-block last">
                            
                                <div class="block-middle">
                                    <div class="block-title">預約取件</div>
                                    <div class="block-content">
                                        <div class="block-content-row" id="pickup_date">{{$pageData->pickupDate}}</div>
                                        <div class="block-content-row" id="pickup_time">{{$pageData->pickupTime}}</div>
                                        <div class="block-content-row"></div>
                                    </div>
                                </div>
                                <div class="block-right">
                                    <div class="block-button"></div>
                                </div>
                            </div>
        
                            <div id="item" style="margin-top: 15px;" class="preview-block withSummary">
                            
                                                                                                                        <div id="ifzero" class="block-middle" style="width:70%">
                                    <div  class="block-title"><span>   標準收納箱 X {{$pageData->pickupNum}}</span></div>
                                    <div class="block-content">
                                        <div id="boxamt">
                                            <div class="block-content-row">
                                                <div class="boxType"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>                            
                            
                  </div> 
                                
                <div class="boxful-card-agree en-GB">
                    <div>
                        <input type="checkbox" id="toc" name="toc">我已閱讀並同意懶人倉 <a target="_blank" href="http://allin-dev.kilikili.idv.tw/page/terms">服務協議</a>
                    </div>
                </div>

                <div id="boxful-paypal-continue" style="display:block">
                <button id="btnSubmit" class="btn-primary morebox-continue" name="action" value="送出" style="width:100px"/>送出</button>
                </div> 
        </div>       


            </div>


        </div>
    </section>
    <div id="bf_error_dialog" title=""></div>
    <!-- end pricing -->
@endsection
@section('js')
    <script type="text/javascript">

        jQuery(document).ready( function($) {

            var msg = "請詳閱懶人倉服務協議並勾選表示同意．";


            $("#btnSubmit").click(function() {
                if($('#toc')[0].checked){
                    $('#submit-form').submit();
            }else {
                $.blockUI({ css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .5, 
                    color: '#fff' 
                },
                message : msg}); 
         
                setTimeout($.unblockUI, 2000);       
                }
            });
        });

    </script>
@endsection