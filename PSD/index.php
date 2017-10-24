<html>
	<head>
		<title></title>	
		<meta name="description" content="">
		<meta property="fb:app_id" content="" />
		<meta property="og:title" content=""/>
		<meta property="og:description" content="" />
		<meta property="og:url" content=""/>
		<meta property="og:image" content=""/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		
	</head>
 <body>
	<div class="main">
		<div class="container">
			<div class="col-sm-12">
				
				<div class="top_section">
					<div class="tab_dv">
						<a data-toggle="tab" href="#home">	
							<div class="top_head">
								<div class="top_img">
									<img src="images/home.png">
								</div>
								<div class="top_text">
									<p>我的位置</p>
								</div>
								<div class="top_num">	
									<span>3</span>
								</div>
							</div>
						</a>
					</div>
					<div class="tab_dv" ondrop="drop(event)" ondragover="allowDrop(event)">
						<a data-toggle="tab" href="#tab1" id="drag">
							
								<div class="top_heads">
									<div class="top_img">
										<img class="truck_img" src="images/truck.png">
									</div>
									<div class="top_texts">
										<p>貨車</p>
									</div>
									<div class="top_num">	
										<span>3</span>
									</div>
								</div>
								
						</a>
					</div>
					<div class="tab_dv">
						<a data-toggle="tab" href="#tab3">
							
								<div class="top_head_3">
									<div class="top_img">
										<img src="images/home2.png">
									</div>
									<div class="top_text">
										<p>我的位置</p>
									</div>
									<div class="top_num">	
										<span>3</span>
									</div>
								</div>
								
						</a>
					</div>
				</div>
				<div class="lines_div">
				</div>
				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">	
						<div class="bottom_section">
							<div class="top_arrow_text">
								<div class="top_arrow">
									<img src="images/arrow.png">
								</div>
								<div class="arrow_text">
									<p>請將箱子拖曳至貨車標籤，即可申請進倉</p>
								</div>
							</div>
							<div class="box_images">
								<div class="top_box_images">
									<div class="single_imgae_box">
										<img class="box_img" src="images/box.png">
									</div>
									<div class="single_imgae_box">
										<img class="box_img" src="images/box.png">
									</div>
									<div class="single_imgae_box">
										<img class="box_img" src="images/box.png">
									</div>
									<div class="single_imgae_box">
										<img class="box_img" src="images/box.png">
									</div>
								</div>
								<div class="bottom_box_images">
									<div class="single_imgae_boxs">
										<img class="box_img" src="images/large_box.png">
									</div>
								</div>	
								<div class="btm_button">
									<button type="button" class="submit_btn" name="submit_btn">下一頁</button>
								</div>
							</div>
							
						</div>
					</div><!-- homepage-->
					<!-- tab2 contents-->
					<div id="tab1" class="tab-pane fade">
						<div class="bottom_sections">
							<div class="arrow_texts">
								<p>進倉中的物品</p>
							</div>
							<div class="box_images">
								<div class="top_box_images">
									<div class="box_imgs">
										<img class="box_imag" src="images/box.png">
										<img class="box_up" src="images/box_up.png">
									</div>
									<div class="box_imgs">
										<img class="box_imag" src="images/box.png">
										<img class="box_up" src="images/box_up.png">
									</div>
									<div class="box_imgs">							
										<img class="box_imag" src="images/box.png">
										<img class="box_up" src="images/box_up.png">
									</div>
									<div class="box_imgs">
										<img class="box_imag" src="images/box.png">
										<img class="box_up" src="images/box_up.png">
									</div>
								</div>
								<div class="bottom_box_images">
									<div class="box_imgss">
										<img class="box_imags" src="images/large_box.png">
										<img class="box_ups" src="images/cycle.png">
									</div>
								</div>	
								<div class="btm_buttons">
									<button type="button" class="submit_btns" name="submit_btn">下一頁</button>
								</div>
							</div>
							
						</div>
					</div>
					<!-- tab3 contents-->
					<div id="tab3" class="tab-pane fade">
						<div class="bottom_section_3">
							<div class="top_arrow_text">
								<div class="top_arrow">
									<img src="images/back_arrow.png">
								</div>
								<div class="arrow_text_3">
									<p>請將箱子拖曳至我的位置標籤，即可申請退倉</p>
								</div>
							</div>
							<div class="box_images">
								<div class="top_box_images">
									<div class="box_imgs_3">
										<img class="box_imag" src="images/box.png">
										<div class="box_up_3">
											<p>冬天衣服</p>
											<img class="box_up_3" src="images/box_up.png" />
										</div>
									</div>
								</div>
									
								<div class="btm_button_3">
									<button type="button" class="submit_btn" name="submit_btn" data-toggle="modal" data-target="#myModal">下一頁</button>
								</div>
							</div>
						
						</div>	
					</div>
					<!-- -->		
					
				</div><!-- tab content-->
				
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
    				<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--<h4 class="modal-title">确认花费￥10解锁此问题</h4>-->
							</div>
							<div class="modal-body">
								<div class="pop_top_div">
									<div class="pop_img">
										<img src="images/popup1.png">
									</div>
									<div class="pop_txt">
										<div class="pop_title">
											<p>冬天衣服</p>
										</div>
										<div class="pop_desc">
											<p>即可申請退倉</p>
										</div>
										<div class="pop_title">
											<p>冬天衣服</p>
										</div>
										<div class="pop_desc">
											<p>199即/可
										</div>
										<div class="pop_title">
											<p>冬天衣服</p>
										</div>
										<div class="pop_desc">
											<p> 2016/09/12</p>
										</div>
										<div class="pop_title">
											<p>冬天衣服</p>
										</div>
										<div class="pop_desc">
											<p>即可申請退倉</p>
										</div>
										<div class="pop_up_btn">
											<button type="button" class="modal_btn1">微信支付</button>
										</div>
										<div class="pop_up_btn_1">
											<button type="button" class="modal_btn1">微信支付</button>
										</div>
										
									</div>
									<div class="pop_btm_dv">
										<div class="pop_imgs">
											<div class="pop_imag">
												<img src="images/pop_up_btm.png">
											</div>
											<div class="pop_imag">
												<img src="images/pop_up_btm.png">
											</div>
											<div class="pop_imag">
												<img src="images/pop_up_btm.png">
											</div>
										</div>
										<div class="pop_home_img">
											<img src="images/pop_home.png">
										</div>
									</div>
								</div>
							</div>
        
						</div>
      
					</div>
				</div><!---model --->
			</div>
		</div>
	</div>
<script>

function allowDrop(event) {
   $("#drag").click();
   return true;
   
}

</script>	
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/box.png" alt="Chania" width="460" height="345">
      </div>

      <div class="item">
        <img src="images/box.png" alt="Chania" width="460" height="345">
      </div>
    
      <div class="item">
        <img src="images/box.png" alt="Flower" width="460" height="345">
      </div>

      <div class="item">
        <img src="images/box.png" alt="Flower" width="460" height="345">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
 </body>
 </html>
