(function() {
	tinymce.PluginManager.add('btn', function(editor, url) {
		var sh_tag = 'btn';
		
		// helper functions
		function getAttr(s, n) {
			n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
			return n ? window.decodeURIComponent(n[1]) : '';
		};
		
		function html(cls, data) {
			var size	= getAttr(data, 'size');
			var color	= getAttr(data, 'color');
			var text	= getAttr(data, 'text');
			var data	= window.encodeURIComponent(data);
			
			return '<a class="btn inline-btn ' + color + '-btn ' + size + ' mceItem ' + cls + '" ' + 'data-sh-attr="' + data + '" data-mce-resize="false" data-mce-placeholder="0" style="display: inline-block; cursor: pointer;">' + text + '</a>';
		}
		
		function replaceShortcodes(content) {
			return content.replace( /\[btn([^\]]*)\]/g, function(all, attr) {
				return html('mce-button-shortcode', attr);
			});
		}
		
		function restoreShortcodes(content) {
			return content.replace( /(?:<p(?:[^>]+)?>)*(<a class="btn inline-btn [^>]+>[^<]+<\/a>)(?:<\/p>)*/g, function(match, anchor) {
				var data = getAttr(anchor, 'data-sh-attr');
				
				if (data) {
					return '<p>[' + sh_tag + data + ']</p>';
				}
				return match;
			});
		}
		
		// add popup
		editor.addCommand('mce-button-shortcode-popup', function(ui, v) {
			// setup defaults
			var size = 'big';
			if (v.size)
				size = v.size;
			var color = 'default';
			if (v.color)
				color = v.color;
			var text = '';
			if (v.text)
				text = v.text;
			var link = 'http://';
			if (v.link)
				link = v.link;
			var target = 'self';
			if (v.target)
				target = v.target;
			
			// updated element will be removed first
			elem = '';
			if (typeof v.elem != 'undefined')
				elem = v.elem;
				
			editor.windowManager.open({
				title	: 'MCE Button Shortcode',
				body	: [
					{
						type		: 'listbox',
						name		: 'size',
						label		: 'Button Size',
						value		: size,
						'values'	: [
							{text: 'Big',	value: 'big'},
							{text: 'Small',	value: 'small'}
						],
						tooltip: 'Select button size'
					},
					{
						type		: 'listbox',
						name		: 'color',
						label		: 'Button Color',
						value		: color,
						'values'	: [
							{text: 'Default',	value: 'default'},
							{text: 'Red',		value: 'red'},
							{text: 'Cyan',		value: 'cyan'},
							{text: 'White',		value: 'white'},
							{text: 'Green',		value: 'green'}
						],
						tooltip: 'Select button color'
					},
					{
						type		: 'textbox',
						name		: 'text',
						label		: 'Button Text',
						value		: text,
						tooltip		: ''
					},
					{
						type		: 'textbox',
						name		: 'link',
						label		: 'Button Link',
						value		: link,
						tooltip		: ''
					},
					{
						type		: 'listbox',
						name		: 'target',
						label		: 'Link Target',
						value		: target,
						'values'	: [
							{text: 'Same Page',	value: 'self'},
							{text: 'New Page',	value: 'blank'}
						],
						tooltip: 'Select link target'
					}
				],
				onsubmit: function(e) {
					// remove updated element
					if (elem)
						elem.parentNode.removeChild(elem);
					
					var shortcode_str = '[' + sh_tag;
					// check for size
					if (typeof e.data.size != 'undefined' && e.data.size.length)
						shortcode_str += ' size="' + e.data.size + '"';
					// check for color
					if (typeof e.data.color != 'undefined' && e.data.color.length)
						shortcode_str += ' color="' + e.data.color + '"';
					// check for text
					if (typeof e.data.text != 'undefined' && e.data.text.length)
						shortcode_str += ' text="' + e.data.text + '"';
					// check for link
					if (typeof e.data.link != 'undefined' && e.data.link.length)
						shortcode_str += ' link="' + e.data.link + '"';
					// check for target
					if (typeof e.data.target != 'undefined' && e.data.target.length)
						shortcode_str += ' target="' + e.data.target + '"';
					
					// close shortcode
					shortcode_str += ']';
					//insert shortcode to tinymce
					editor.insertContent(shortcode_str);
				}
			});
		});
		
		// add button
		editor.addButton('btn', {
			icon	: 'mce-button-shortcode',
			tooltip	: 'MCE Button Shortcode',
			onclick	: function() {
				editor.execCommand('mce-button-shortcode-popup', '', {
					size	: 'big',
					color	: 'default',
					text	: '',
					link	: 'http://',
					target	: 'self'
				});
			}
		});
		
		// replace from shortcode to an image placeholder
		editor.on('BeforeSetcontent', function(event) {
			event.content = replaceShortcodes(event.content);
		});
		
		// replace from image placeholder to shortcode
		editor.on('GetContent', function(event) {
			event.content = restoreShortcodes(event.content);
		});
		
		// open popup on placeholder double click
		editor.on('Click', function(e) {
			var cls = e.target.className.indexOf('inline-btn');
			if ( e.target.nodeName == 'A' && e.target.className.indexOf('mce-button-shortcode') > -1 ) {
				var title = e.target.attributes['data-sh-attr'].value;
				title = window.decodeURIComponent(title);
				
				editor.execCommand('mce-button-shortcode-popup', '', {
					size	: getAttr(title, 'size'),
					color	: getAttr(title, 'color'),
					text	: getAttr(title, 'text'),
					link	: getAttr(title, 'link'),
					target	: getAttr(title, 'target'),
					elem	: e.target
				});
			}
		});
	});
})();