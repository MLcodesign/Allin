<!-- start footer -->
<section id="footer">
<div class="container">
    <div class="row">
		 <div class="col-md-6 footerbox1">
	        <span class="text-left">
		       <a href="{{url('/page/privacy')}}">隱私權政策</a> | <a href="{{url('/page/terms')}}">懶人倉服務協議</a>@if(isset($page) && $page->id == 7) | <a href="{{url('/page/terms-self-storage')}}">迷你倉服務協議</a> @endif
		    </span>
		</div>
		
		<div class="col-md-6 footerbox2">
		<span>
		 {{ getSetting('SUPPORT_PHONE') }} | <a href="mailto:{{ getSetting('INFO_EMAIL') }}">{{ getSetting('INFO_EMAIL') }}</a>
		</span>
		</div><!-- Container ends here -->
	 </div>
	 <div class="row">
	   <div class="col-md-12 text-center">
	     <p class="copy">{!! getSetting('FRONTEND_FOOTER') !!}</p>
	   </div>
	 </div>
	<p id="back-top">
		<a href="#top"><span></span></a>
	</p>	 
</div>
</section>
