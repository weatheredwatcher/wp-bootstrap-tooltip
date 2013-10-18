(function() {
    tinymce.create('tinymce.plugins.vz_tooltip', {
        init : function(ed, url) {
        
        	ed.addCommand('vz_tooltip_cmd', function() {
				ed.windowManager.open({
					file : url + '/tooltip_popup.php',
					width : 340 + parseInt(ed.getLang('button.delta_width', 0)),
					height : 350 + parseInt(ed.getLang('button.delta_height', 0)),
					inline : 1
					}, {
					plugin_url : url
				});
			});

            ed.addButton('vz_tooltip', {
                title : 'Insert Tooltip',
                image : url + '/tooltip.png',
                cmd: 'vz_tooltip_cmd'
            });
        },
		getInfo : function() {
			return {
				longname : "Verizon Tooltip Shortcode",
				author : 'David Duggins',
				authorurl : 'http://weatheredwatcher.com/',
				infourl : 'http://weatheredwatcher.com/',
				version : "1.0"
			};
		}
    });
    tinymce.PluginManager.add('vz_tooltip', tinymce.plugins.vz_tooltip);
})();
