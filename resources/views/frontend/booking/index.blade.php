@extends('layouts.frontend.single')

@section('title', '歡迎您的加入 Welcome')

@section('css')

@endsection

@section('content') 
<!-- ============= Pricing table Starts Here =============================--> 
<section id="inner_content">
  <div class="container">
    <h1 style="text-align:center;"><b>歡迎您的加入</b></h1>
    <h4 class="subtitle">Welcome</h4>
    <p class="y_line"></p>
    <h3 class="text-center">Hi {{Auth::user()->name}}, 歡迎您加入ALL IN 精品倉儲，請輸入您的基本資料</h3>
    <div class="row"> @foreach($packages as $i => $package)
      <div class="col-md-4 col-md-offset-{{
		  ($i == 0) ? 4-count($packages) : 0}}" >
        <div class="inner">
          <div class="row">
            <div class="col-md-12"> <img src="{{ $package->features[3]->pivot->spec }}" class="img-responsive center-block" @if(isset($package->features[4]) && $package->features[4]->isActive()) width="{{ $package->features[4]->pivot->spec }}"  @endif > </div>
            <div class="col-md-12">
              <h1 class="text-center" id="inner-head">{{ $package->name }}</h1>
            </div>
            <div class="col-md-12 text-center">
              <h2><b>{{ round($package->cost) }}{{ getSetting('DEFAULT_CURRENCY') }}</b> <span class="small">/{{ $package->cost_per }}</span></h2>
              <small>{{ $package->features[0]->pivot->spec }}</small>
              <hr> 
            </div>
            <div class="col-md-12 text-center">
              <div class="inner-icon"> <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp; <span>{{ $package->features[1]->pivot->spec }}</span><br>
                <i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp; <span>{{ $package->features[2]->pivot->spec }}</span> </div>
            </div>
            <div class="col-md-12">
              <form action="{{ url('/booking/1') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" value="{{ $package->id }}" name="package_id" />
                <input type="submit" class="btn btn-link text-uppercase" id="inner-button" value="立即預約">
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach </div>
  </div>
</section>
@endsection 