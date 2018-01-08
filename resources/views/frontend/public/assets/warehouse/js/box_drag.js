$(".small_img").click(function(){
	var img_src=$(this).attr('src');
	$("#main_img").attr("src",img_src);
});
function allowDrops(event){
	$("#drag").click();
	return true;
}
function allowDrop(ev) {
    ev.preventDefault();
	$("#drag").click();
	return true;
}
function drag(ev) {
    ev.dataTransfer.setData("text/plain", ev.target.id);
}
function drop(event) {	
	//var text_id=id;
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    document.getElementById("box_div_"+data).appendChild(document.getElementById(data));
	//$(".upload"+data).show();
	//$(".thumb_u_"+data).hide();
}
function all_move(id) {	
	//var text_id=id;
    var data = id;
    document.getElementById("box_div_"+data).appendChild(document.getElementById(data));
	//$(".upload"+data).show();
	//$(".thumb_u_"+data).hide();
}
$(".box_img_block .thumb_u_img").click(function(){
	var img_id=$(this).attr('id');
	$("#thumb_upload"+img_id).trigger('click');
}); 
function upload(input,id){
    if (input.files && input.files[0]) {
		var box_id = id;
        var reader = new FileReader();
        reader.onload = function (e) {
		$('#thumb'+box_id)
            .attr('src', e.target.result)
			.width(95)
			.height(102);
		};
		reader.readAsDataURL(input.files[0]);
    }
    $("#thumb"+box_id).show();
	$(".thumb_txt_"+box_id).hide();
}
/*$(".uploadable_div").click(function(){
	var img_id=$(this).attr('id');
	$("#box_div_file"+img_id).trigger('click');
});*/ 

/*function readURL(input,id){
    if (input.files && input.files[0]) {
		var box_id = id;
        var reader = new FileReader();
        reader.onload = function (e) {
		$('#blah'+box_id)
            .attr('src', e.target.result)
			.width(95)
			.height(102);
		};
		reader.readAsDataURL(input.files[0]);
    }
    $("#blah"+box_id).show();
	$(".upload_txt_"+box_id).hide();
}*/


function imageupload(input, id) {
    if (input.files && input.files[0]) {
        var box_id = id;
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#thumb' + box_id)
                .attr('src', e.target.result)
                .width(95)
                .height(102);
        };
        reader.readAsDataURL(input.files[0]);
    }
    $("#thumb" + box_id).show();
    $(".thumb_txt_" + box_id).hide();
    return false;
}