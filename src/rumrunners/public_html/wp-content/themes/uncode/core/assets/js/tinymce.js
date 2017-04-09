(function() {
	tinymce.create('tinymce.plugins.mark', {
		init: function(ed, url) {
			ed.addButton('markbutton', {
				title: 'Mark',
				cmd: 'markbutton',
				icon: 'backcolor'
			});
			ed.addCommand('markbutton', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '<mark>' + selected_text + '</mark>';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
		},
	});
	// Register plugin
	tinymce.PluginManager.add('uncodemarkbutton', tinymce.plugins.mark);
})();