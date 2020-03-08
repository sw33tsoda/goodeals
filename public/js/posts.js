$('#preview_img').hide();
$('#upload_image_button').click(function(){ 
  $('#imgInput').trigger('click'); 
});
function preview_image(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();      
    reader.onload = function (e) {
        $('#preview_img').attr('src', e.target.result);
        $('#preview_img').show(500);
        $('#preview_ghost').hide(100);
    }     
    reader.readAsDataURL(input.files[0]);
  }
} 
$("#imgInput").change(function(){
    preview_image(this);
});