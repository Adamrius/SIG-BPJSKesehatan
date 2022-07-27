jQuery.fn.extend({
    createRepeater: function (options = {}) {
        var hasOption = function (optionKey) {
            return options.hasOwnProperty(optionKey);
        };
 
        var option = function (optionKey) {
            return options[optionKey];
        };
 
        var generateId = function (string) {
            return string
                .replace(/\[/g, '_')
                .replace(/\]/g, '')
                .toLowerCase();
        };
 
        var addItem = function (items, key, fresh = true) {
            var itemContent = items;
            var itemClone   = items;
            var group = itemContent.data("group");
            var item  = itemContent;
            var input = item.find('input,select,textarea');
 
            input.each(function (index, el) {
                var attrName = $(el).data('name');
                var skipName = $(el).data('skip-name');

                if (skipName != true) {
                    $(el).attr("name", group + "[" + key + "]" + "[" + attrName + "]");
                } 
                else {
                    if (attrName != 'undefined') {
                        $(el).attr("name", attrName);
                    }
                }
                if (fresh == true) {
                    $(el).attr('value', '');
                }
 
                $(el).attr('id', generateId($(el).attr('name')));
                $(el).parent().find('label').attr('for', generateId($(el).attr('name')));
            })
 
            // remove items
            var removeButton = itemClone.find('.repeater-remove-items');
            if (key == 0) {
                removeButton.attr('disabled', true);
            } else {
                removeButton.attr('disabled', false);
            }
            removeButton.attr('onclick', '$(this).parents(\'.repeater-items\').remove()');

            // add items
            var newItem = $('<div class="repeater-items animated fadeIn">' + itemClone.html() + '</div>');
            newItem.attr('data-index', key);

            // title repeater
            var repeaterTitle = newItem.find('.repeater-title');
            repeaterTitle.text('Listicle '+(key+1));
            
            // var summernoteElement2 = find('textarea[name$="deskripsi_listicle"]');
            // var summernoteElement2 = newItem.find('textarea');
            // summernoteElement2.summernote({
            //     placeholder: 'Masukan content artikel Anda.',
            //     fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '46'],
            //     lineHeights: ['1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '2.0', '3.0'],
            //     height: 250,
            //     codeviewFilter: true,
            //     dialogsInBody: true,
            //     toolbar: [
            //     ['style', ['style']],
            //     ['font', ['bold', 'underline', 'clear']],
            //     ['color', ['color']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['table', ['table']],
            //     ['insert', ['link', 'picture', 'video']],
            //     ['view', ['fullscreen', 'codeview', 'help']]
            //     ],
            //     callbacks: {
            //         onChange: function (contents, $editable) {
            //             summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
            //         },
            //         onPaste: function (e) {
            //             var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            //             e.preventDefault();
            //             bufferText = bufferText.replace(/\r?\n/g, '<br>');
            //             document.execCommand('insertHtml', false, bufferText);
            //         }
            //     }
            // });

            newItem.appendTo(repeater);
        };
 
        /* find elements */
        var repeater = this;
        var items = repeater.find(".repeater-items");
        var key = 0;
        var addButton = $('.repeater-add-items');

        items.each(function (index, item) {
            items.remove();

            if (hasOption('showFirstItemToDefault') && option('showFirstItemToDefault') == true) {
                addItem($(item), key);
                key++;
            } 
            else {
                if (items.length > 1) {
                    addItem($(item), key);
                    key++;
                }
            }
        });
 
        /* handle click and add items */
        addButton.on("click", function () {
            addItem($(items[0]), key);
            key++;
        });
    }
});