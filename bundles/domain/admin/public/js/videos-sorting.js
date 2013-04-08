jQuery(function($){

    $('[data-vid]').each(function(){
        var $this = $(this);
        $this.closest('.control-group').attr('data-vid',$this.data('vid'));
    });

    $('.draggable').each(function(){
        var $this = $(this);
        $this.sortable({
            items: '.control-group',
            update: function( event, ui ) {
                var sorted_ids = $this.sortable('toArray', {attribute: 'data-vid'});
                var ids_count = sorted_ids.length;
                for(var i=0; i< ids_count; i++){
                    var item_id = sorted_ids[i];
                    var item_name = 'pivot[videos]['+item_id+'][weight]';
                    var position = ids_count - i;
                    $this.find('input[name="'+item_name+'"]').val( position );
                }
            },
            forcePlaceholderSize: true,
            // handle: '.control-group',
            placeholder: "video-placeholder"
        });
        $this.disableSelection();
        $this.find('.video-detail').enableSelection();
    });

});