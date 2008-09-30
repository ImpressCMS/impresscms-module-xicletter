function insertXimage(file_name, title) {
	title = tinyMCE.getLang(title);

	if (title == null)
		title = "";

	// XML encode
	title = title.replace(/&/g, '&amp;');
	title = title.replace(/\"/g, '&quot;');
	title = title.replace(/</g, '&lt;');
	title = title.replace(/>/g, '&gt;');

	var html = '<img src="' + file_name + '" mce_src="' + file_name + '" border="0" alt="' + title + '" title="' + title + '" />';

	tinyMCE.execCommand('mceInsertContent', false, html);
	tinyMCEPopup.close();
}