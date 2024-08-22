define([
    "jquery",
    "TYPO3/CMS/Core/Ajax/AjaxRequest"
], function ($, AjaxRequest) {
    
    var CopyPasteInlineRecord = {
        pasteButtonSelector: ".copy-paste-inline-record",
    };

    CopyPasteInlineRecord.init = function () {
        $(CopyPasteInlineRecord.pasteButtonSelector).on("click", function(){
            // Generate a random number between 1 and 32
            const randomNumber = Math.ceil(Math.random() * 32);
            new AjaxRequest(TYPO3.settings.ajaxUrls.threeam_inline_copypaste_paste_element)
                .withQueryArguments({ input: randomNumber })
                .get()
                .then(async function (response) {
                    const resolved = await response.resolve();
                    console.log(resolved.result);
                });
        });
    };

    CopyPasteInlineRecord.init();
    
    // To let the module be a dependency of another module, we return our object
    return CopyPasteInlineRecord;
});
