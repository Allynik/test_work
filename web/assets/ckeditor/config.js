/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
window.CKEDITOR_BASEPATH = CKEDITOR.basePath = "/assets/ckeditor/";

CKEDITOR.editorConfig = function( config ) {
    config.filebrowserBrowseUrl = "/assets/elfinder/elfinder.html?type=files";
    config.filebrowserLinkBrowseUrl = "/assets/elfinder/elfinder.html?type=files";
    config.filebrowserImageBrowseUrl = "/assets/elfinder/elfinder.html?type=images";
    config.filebrowserFlashBrowseUrl = "/assets/elfinder/elfinder.html?type=flash";

    // config.filebrowserUploadUrl = "/userfiles.php?type=userfiles";
    config.filebrowserUploadUrl = false;

    config.language = "en";
    config.uiColor = "#F0F0F0";
    config.skin = "moono-lisa";
    config.toolbarCanCollapse = true;

    config.extraPlugins = "justify,embed,pastefromword,image2,showprotected,showblocks,div,specialchar,selectall,find,templates,preview,newpage,print,emoji";
    config.removePlugins = "image,exportpdf";

    config.image2_alignClasses = ['pull-left', 'text-center', 'pull-right'];
    config.image2_captionedClass = 'figure',

    config.allowedContent = true;
    config.disallowedContent = "html body head meta";
    config.pasteFilter = "semantic-content";
    config.pasteFromWordPromptCleanup = true;
    config.format_tags = "p;h2;h3;h4;h5;h6;pre;address;div";

    config.embed_provider = "//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}";

    config.cloudServices_tokenUrl = false;
    config.cloudServices_uploadUrl = false;

    config.templates_files = [
        CKEDITOR.getUrl("templates/bootstrap.js")
    ];

    if (config.specialChars) {
        var charColumns = 17;
        var popChars = ["—", "–", "«", "»", "₽", "€", "§", "≈", "©", "®", "™", "←", "↓", "→", "↑", "…", "•"];
        var fillChars = new Array(charColumns - (popChars.length % charColumns) + charColumns);
        config.specialChars = popChars.concat(fillChars, config.specialChars);
    }
};

CKEDITOR.on("instanceReady", function(readyEvent) {
    var processContent = function (doc) {
        // table processing
        jQuery("table", doc).removeAttr("height").css("height", "");

        jQuery("table:not(.table), table[border=\"1\"]", doc).addClass("table").removeClass("table-borderless");
        jQuery("table[border=\"0\"]", doc).addClass("table").removeClass("table-bordered").addClass("table-borderless");

        jQuery("table.table", doc).each(function() {
            var table = jQuery(this);
            table.removeAttr("cellpadding");
            table.removeAttr("cellspacing");
            // table processing: wrap responsive class
            var wrapper = table.parent(".table-responsive");
            if (!(wrapper && wrapper.length)) {
                table.wrap("<div class=\"table-responsive\"></div>");
            }
        });

        // img processing: add responsive classes, remove height
        jQuery("img", doc).addClass("img-fluid").removeAttr("height").css("height", "");

        // img processing: convert align=right to float
        jQuery("img[align='right'],img.pull-right", doc).each(function() {
            var img = jQuery(this);
            img.removeAttr("align");
            img.removeClass("pull-left pull-right");

            var floating = img.css("float");
            if (!(floating == 'left' || floating == 'right')) floating = 'right';

            var wrapper = img.closest("figure");
            var widget = img.closest(".cke_widget_image");

            if (widget && widget.length) {
                widget.css("float", floating);
                widget.removeClass("pull-left pull-right");
                widget.addClass("pull-" + floating);
            }
            if (wrapper && wrapper.length) {
                img.css("float", "");
                wrapper.css("float", floating);
                wrapper.removeClass("pull-left pull-right");
                wrapper.addClass("pull-" + floating);
            } else {
                img.css("float", floating);
                img.addClass("pull-" + floating);
            }
        });

        // img processing: convert align=left to float
        jQuery("img[align='left'],img.pull-left", doc).each(function() {
            var img = jQuery(this);
            img.removeAttr("align");
            img.removeClass("pull-left pull-right text-center");

            var floating = img.css("float");
            if (!(floating == 'left' || floating == 'right')) floating = 'left';

            var wrapper = img.closest("figure");
            var widget = img.closest(".cke_widget_image");

            if (widget && widget.length) {
                widget.css("float", floating);
                widget.removeClass("pull-left pull-right text-center");
                widget.addClass("pull-" + floating);
            }
            if (wrapper && wrapper.length) {
                img.css("float", "");
                wrapper.css("float", floating);
                wrapper.removeClass("pull-left pull-right text-center");
                wrapper.addClass("pull-" + floating);
            } else {
                img.css("float", floating);
                img.addClass("pull-" + floating);
            }
        });

        // img processing: convert align=center
        jQuery("img[align='center'],img.text-center,.text-center img", doc).each(function() {
            var img = jQuery(this);
            img.removeAttr("align");
            img.removeClass("pull-left pull-right text-center");

            var wrapper = img.closest("figure");
            var widget = img.closest(".cke_widget_image");

            if (widget && widget.length) {
                widget.css("float", "");
                widget.removeClass("pull-left pull-right");
                widget.addClass("text-center");
            }
            if (wrapper && wrapper.length) {
                img.css("float", "");
                wrapper.css("float", "");
                wrapper.removeClass("pull-left pull-right");
                wrapper.addClass("text-center");
            } else {
                img.css("float", "");
                img.addClass("text-center");
            }
        });

        // iframe process
        jQuery("iframe[frameborder]", doc).each(function() {
            var iframe = jQuery(this);
            iframe.css("border-width", iframe.attr("frameborder"));
            iframe.removeAttr("frameborder");
        });
    };

    var doc = null;
    try {
        doc = jQuery("iframe", (readyEvent.editor.container).$)[0].contentWindow.document;
    } catch (error) {
        doc = null;
        console.log(error);
    }
    if (doc) {
        processContent(doc);
    }

    readyEvent.editor.on("change", function(event) {
        var doc = null;
        try {
            doc = jQuery("iframe", (event.editor.container || readyEvent.editor.container).$)[0].contentWindow.document;
        } catch (error) {
            doc = null;
            console.log(error);
        }
        if (doc) {
            processContent(doc);
        }
    });
});

CKEDITOR.on("dialogDefinition", function (event) {
    if (event.data.name == "image") {
        var advancedTab = event.data.definition.getContents("advanced");
        // img processing: add responsive class
        advancedTab.get("txtGenClass")["default"] = "img-fluid";
    } else if (event.data.name == "image2") {
          event.data.definition.onFocus = function() {
              // img processing: remove height
              var heightInput = this.getContentElement("info", "height");
              jQuery("#" + heightInput.domId).parent().hide();
              // img processing: disable lock ratio
              var lockInput = this.getContentElement("info", "lock");
              jQuery(".cke_btn_locked", "#" + lockInput.domId).hide();
          };
    } else if (event.data.name == "table") {
        var infoTab = event.data.definition.getContents("info");
        infoTab.get("txtWidth")["default"] = "100%";
        infoTab.get("txtBorder")["default"] = 1;
        // table processing: remove html4 attrs
        infoTab.remove("txtHeight");
        infoTab.remove("txtCellPad");
        infoTab.remove("txtCellSpace");
    }
});
