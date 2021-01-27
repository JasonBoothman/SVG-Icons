$(function(){
	$(document).on("click touchend", ".svg-icon .copy-data", function(e){

        e.preventDefault();

        $this = $(this);

        $type = $(this).data('type');

        $parent = $(this).parent().closest('.svg-icon');
        $parent_label = $parent.data('label');

        $tag_data = $('[data-label="' + $parent_label + '"] .' + $type + '-data');
        $tag_data.select();

        document.execCommand('copy');

        $parent.addClass('copied');
		setTimeout(function(){ $parent.removeClass('copied'); }, 1500);
	});
});