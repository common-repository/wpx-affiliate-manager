jQuery(document).ready(function($) {

    $("td").each(function(index, obj) {
        var $buttonId;
        var $textId;
        $nestedElement = $(obj).children("input.WPXAMUpload");
        $nestedElement.click(function(){
            $textInput = $(this).siblings(".WPXAMUrl");
            textInputId = $textInput.attr("id");
            tb_show('',"media-upload.php?type=image&TB_iframe=true");
            return false;
        });
    });
    
    window.send_to_editor = function(html) {
        imgurl = jQuery('img',html).attr('src');
        jQuery("input"+"#"+textInputId).val(imgurl);
        tb_remove();
    }
});