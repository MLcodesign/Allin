@extends('emails.allin')

@section('title', 'Schedule Pick Up')

@section('css')

@endsection

@section('content')
<center>
<table>
	<tbody>
		<tr>
			<td>
			預約取件
			</td>
			<td>
			@if(NULl !== $request->get('ship_date'))
				<span class="display-value">{{ $request->get('ship_date') }}</span>
			@endif
			 @if(NULl !== $request->get('ship_time'))
				/<span class="display-value">{{ $request->get('ship_time') }} </span>
			@endif
			</td>
		</tr>
		
		<tr>
			<td>
			預訂數量 
			</td>
			<td>
			@if(NULl !== $request->get('quantity'))
				<span class="display-value">{{ $request->get('quantity') }}</span>
			@endif
			</td>
		</tr>

		<tr>
			<td>
			地址
			</td>
			<td>
			
			@if(NULl !== $request->get('county'))
				{{ $request->get('county') }} {{ $request->get('district') }} {{ $request->get('zipcode') }}<br/>
			@endif
			@if(NULl !== $request->get('address'))
				{{ $request->get('address') }}
			@endif
			</td>
		</tr>
		
		
		<tr>
			<td>
			我的箱子
			</td>
			<td>
			@foreach($boxes as $i => $box)
			<div class="col-xs-12 col-sm-4">
				<p>{{ $box->admin_id }}</p>
				<p><span>{{ $request->get('box_pickup')[$i+1]['name'] }}</span>
				<br/>
					@if(isset($pictures[$i]))
						<img style="height:80px; width:auto" src="/uploads/boxes/{{$pictures[$i]}}"/>
					@else
						<div class="img-none"></div>
						@endif
				</p>

			</div>
			@endforeach
			</td>
		</tr>
		
	</tbody>
</table>
</center>
@endsection