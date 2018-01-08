<div class="checkoutHeader">
  <div class="checkoutHeaderContainer">
    <div class="checkoutHeaderRight">
	  <div class="checkoutStepBar">
		<div class="processBarContainer">
		  <div class="processBar"></div>
		  <div id="currentProcess" class="currentProcess"></div>
		</div>
	  </div>
	  <div class="checkoutStepDetail">
	  @foreach($steps as $i => $step)
		<div id="step{{$i+1}}" class="{{ $current_step == ($i+1) ? 'active' : '' }}" >
		  <div class="stepItem"><a href="#"><font>{{ $i+1 }}</font></a></div>
		  <div class="stepItemTitle"><a href="#">{{ $steps_chinese[$i] }}</a></div>
		</div>
		@endforeach
	  </div>
	</div>
  </div>
</div>
