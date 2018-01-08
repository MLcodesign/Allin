@extends('emails.allin')

@section('title', {{$subject}})

@section('css')

@endsection

@section('content')
<center>
<table>
	<tbody>
		<tr>
		<th>預約時間</th>
			<td>
			@if(NULl !== $request->get('dropOffDate'))
				<span class="display-value">{{ $request->get('dropOffDate') }}</span>
			@endif
			 @if(NULl !== $request->get('dropOffTime'))
				/<span class="display-value">{{ $request->get('dropOffTime') }} </span>
			@endif
			</td>
		</tr>
		
		<tr>
			<th>
			預訂數量
			</th>
			<td>
			@if(NULl !== $request->get('box_quantity'))
				<span class="display-value">{{ $request->get('box_quantity') }}</span>
			@endif
			</td>
		</tr>

		<tr>
			<th>
			地址
			</th>
			<td>
			
			@if(NULl !== $request->get('county'))
				{{ $request->get('county') }} {{ $request->get('district') }} {{ $request->get('zipcode') }}</p>
			@endif
			@if(NULl !== $request->get('address'))
				<br/>{{ $request->get('address') }}
			@endif
			</td>
		</tr>
		
	</tbody>
</table>
</center>
@endsection