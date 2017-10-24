@extends('layouts.admin.app')

@section('title', 'Users')

@section('css')
{!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
@endsection


@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-user"></i> {{ isset($user) ? '編輯' : '新增' }} User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li><a href="{{ url('admin/users') }}"><i class="fa fa-users"></i> 會員</a></li>
        <li class="active"><i
                    class="fa {{ isset($user) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($user) ? '編輯' : '新增' }}
            會員
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' =>  isset($user) ? 'admin/users/'.$user->id  :  'admin/users', 'method' => isset($user) ? 'put' : 'post', 'files' => true, 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            {!! Form::hidden('user_id', isset($user) ? $user->id: null) !!}
            <fieldset>
                <legend>帳戶資訊</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', '姓名 *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    {!! Form::text('name', old('name', isset($user) ? $user->name: null), ['class' => 'form-control validate[required]', 'placeholder'=>'姓名']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    {!! Form::email('email', old('email', isset($user) ? $user->email: null), ['class' => 'form-control validate[required,custom[email]]', 'placeholder'=>'Email']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', '密碼', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            {!! Form::label('password_confirmation', '確認', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    {!! Form::password('password_confirmation', ['class' => isset($user) ? 'form-control validate[equals[password]]': 'form-control validate[required,equals[password]]' ]) !!}
                                </div>
                            </div>
                        </div>
                    </div><!-- .col-md-6 -->

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('role', '權限 *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::select('role', array_add($roles, '','Please Select'), old('role', isset($user) ? $user->role_id: null), ['class' => 'form-control select2 validate[required]']) !!}
                            </div>
                        </div>
						<div class="form-group">
                            {!! Form::label('total_credit', '點數', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('total_credit', old('total_credit', isset($user) ? $user->total_credit: null), ['class' => 'form-control validate[required]', 'placeholder'=>'點數']) !!}
                            </div>
                        </div>
						
						<div class="form-group">
                            {!! Form::label('note', '備註', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('note', '', ['class' => 'form-control', 'placeholder'=>'點數調整內容描述']) !!}
                            </div>
                        </div>

                    </div><!-- .col-md-6 -->
                </div><!-- .row -->
            </fieldset>
            <fieldset>
                <legend>聯絡資料</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('mobile', '電話', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                    {!! Form::text('mobile', old('mobile', isset($user) ? $user->mobile: null), ['class' => 'form-control', 'placeholder'=>'手機']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('package_id', '方案', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::select('package_id', array_add($packages, '','Please Select'), old('package_id', isset($user) && $user->package_id != 0 ? $user->package_id: null), ['class' => 'form-control select2']) !!}
                            </div>
                        </div>
						<div class="form-group">
							{!! Form::label('address', '地址 *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
								<div id="twzipcode">
									<div class="col-md-4" style="padding: 0;">
									<div data-role="county"
									   data-name="county"
									   id = "county"
									   data-value="{{ $user->county or '' }}"
									   data-style="county form-control"> </div>
									</div>
									<div class="col-md-4" style="padding: 0;">
									<div data-role="district"
									   id = "district"
									   data-name="district"
									   data-value="{{ $user->district  or '' }}"
									   data-style="district form-control"> </div>
									</div>
									<div class="col-md-4" style="padding: 0;">
									<div data-role="zipcode"
									   data-name="zipcode"
									   id = "zipcode"
									   data-value="{{ $user->zipcode  or '' }}"
									   data-style="zipcode form-control"> </div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', '地址 *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('address', old('address', isset($user) ? $user->address: null), ['class' => 'form-control validate[required]', 'placeholder'=>'地址']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                {!! Form::submit((isset($user)?'Update': '新增'). ' 會員', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div><!-- .col-md-6 -->
                </div><!-- .row -->
            </fieldset>
            {!! Form::close() !!}
			@if(isset($user))
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;" data-user-id="{{ $user->id }}">
                <thead>
                <tr>
                    <th>使用日期</th>
                    <th>調整類別</th>
                    <th>內容描述</th>
                    <th>點數</th>
                    <th>儲值紀錄</th>
					<th>調整後點數餘額</th>
                </tr>
                </thead>
                <tbody>

               </tbody>
            </table>
			@endif
        @if(isset($deposits))
        <!-- table1 扣點記錄 Start -->      
         <div class="">
          <div id="cardInfoForm1" class="div-td1 schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">取消還點記錄</span></div>
            <div class="div-table billing" style="width:100%">
              <div id="invoiceContent">
                <div class="table-responsive" id="scroll_table">
                  <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                    <thead>
                      <tr>
                        <th>交易編號</th>
                        <th>交易日期</th>
                        <th>返還點數</th>
                        <th>交易類別</th>
                        <th>關連代碼</th>
                        <th>註記</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $sum = 0; ?>    
                    @foreach($deposits as $i => $de)
                    <tr>
                      <td> #{{ $de->id }} </td>
                      <td> {{ $de->created_at}}</td>
                      <td> {{ $de->p_cnt}}</td>
                      <td> {{ $de->getCategory()->name }} </td>
                      <td> {{ $de->api_key }} </td>
                      <td> {{ $de->api_memo_note }} </td>
                      <?php $sum += $de->p_cnt; ?>
                    </tr>
                    @endforeach
                    <tr>
                      <td>合計</td>
                      <td>&nbsp;</td>
                      <td> {{ $sum }} </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>                    
                      </tbody>

                  </table>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        @endif
        <!-- table1 扣點記錄 End -->          
        <!-- table2 扣點記錄 Start -->
        @if(isset($exchanges))
        <div class="">
          <div id="cardInfoForm1" class="schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">扣點紀錄</span></div>
            <div class="div-table billing" style="width:100%">
              <div id="invoiceContent">
                <div class="table-responsive" id="scroll_table">
                  <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                    <thead>
                      <tr>
                        <th>扣點編號</th>
                        <th>扣點類別</th>
                        <th>扣點日期</th>
                        <th>對應訂單</th>
                        <th>點數</th>
                        <th>備註</th>

                      </tr>
                    </thead>
                    <tbody>

                    <?php $sum = 0; ?>    
                    @foreach($exchanges as $i => $ex)
                    <tr>
                      <td> {{ $i+1 }} </td>
                      <td> {{ $ex->getCategory()->name }} </td>
                      <td> {{ date('Y-m-d', strtotime($ex->created_at)) }} </td>
                      <td> @if($ex->op_type == "system")
                      新建單
                      @else
                      退倉物流
                      @endif #{{ $ex->api_key }} </td>
                      <td> {{ $ex->p_cnt}} </td>
                      <td> {{ $ex->api_memo_note }}</td>
                      <?php $sum += $ex->p_cnt; ?>
                    </tr>
                    @endforeach
                    
                    <tr>
                      <td>合計</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td> {{ $sum }} </td>
                      <td>&nbsp;</td>
                    </tr>
                      </tbody>

                  </table>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        @endif
        <!-- table2 扣點記錄 End -->  
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection


@section('js')
{!! Html::script('/assets/plugins/lightbox/js/lightbox.js') !!}

<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script>
        <!-- iCheck 1.0.1 -->
{!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

{!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

{!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

{!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

{!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

<script type="text/javascript">

$('#twzipcode').twzipcode();

    $(document).ready(function () {
        //Initialize Select2 Elements
        $(".select2").select2({
            placeholder: "Please Select",
            allowClear: true
        });

        // Validation Engine init
        var prefix = 's2id_';
        $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
                
        var table = $("#data_table").DataTable({
            bLengthChange : false,
            bInfo : false,
            bPaginate: false,
            bFilter: false,
            processing: true,
            serverSide: true,
            ajax: '{!! url("admin/datatables/userdeposits") !!}' + "/" + $("#data_table").data('user-id'),
            columns: [
                {data: 'created_at', name: 'created_at'},
                {data: 'api_memo_note', name: 'api_memo_note'},
                {data: 'api_system_note', name: 'api_system_note'},
                {data: 'p_cnt', name: 'p_cnt'},
                {data: 'pay_amt', name: 'pay_amt'},
				{data: 'user_credit', name: 'user_credit'}
            ]
        });
        
        table.column('0:visible').order('desc').draw();
    });
</script>
@endsection
