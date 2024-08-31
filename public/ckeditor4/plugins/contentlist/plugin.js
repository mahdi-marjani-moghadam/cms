CKEDITOR.plugins.add('contentlist', {
    // اگر از آیکون استفاده نمی‌کنید، این خط را حذف کنید
    icons: 'contentlist',
    init: function (editor) {
        // افزودن دستور
        editor.addCommand('insertContentList', {
            exec: function (editor) {
                var contentListTag = '[content-list ids="" category="" limit="3"]';
                editor.insertText(contentListTag);
            }
        });

        // افزودن دکمه به نوار ابزار
        editor.ui.addButton('ContentList', {
            label: 'Insert Content List',
            command: 'insertContentList',
            toolbar: 'insert'
        });
    }
});
