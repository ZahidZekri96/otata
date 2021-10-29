window.custmAjaxHolder = [];
window.manualLoaderHide = false;

const custmAlertToster = {
    error: function (response) {

        console.error('Error :', response);

        let error = response;
        if( typeof error == "string" ) {
            let errors = error.split("\n");
            $.each(errors, function (index, value) {
                toastr.error(value, {timeout: 5000});
            });
        }
        else{
            toastr.error(error, {timeout: 5000, closeOnHover: true,});
        }
    },
    success: function (response) {
        let msg = response;
        toastr.success(msg, {timeout: 5000});
    }
};

const refreshListner = function (selector, eventList=[], callbacks={}) {
    if( eventList.length > 0 ){
        $.each(eventList, function (index, value) {
            $(selector).unbind(value);
            callbacks[value];
        })
    }
    else {
        $(selector).unbind();
    }
}

const processSerialize = function (data) {
    var fData = {};
    $.each(data, function (index, value) {
        if( fData.hasOwnProperty(value.name) ){
            let oriData = fData[value.name];
            if( $.isArray(oriData) ){
                oriData.push(value.value);
                fData[value.name] = oriData;
            }
            else {
                let oriDataN = [oriData];
                oriDataN.push(value.value);
                fData[value.name] = oriDataN;
            }
        }
        else{
            fData[value.name] = value.value;
        }
    });

    return fData;
};

const extend = function (obj, src) {
    for (var key in src) {
        if (src.hasOwnProperty(key)) obj[key] = src[key];
    }
    return obj;
};

const isFailed = function (variable) {

    if( typeof variable === 'undefined' )
        return true;

    if( variable === null )
        return true;

    if( variable === "null" || variable === "NULL" )
        return true;

    if( variable === "false" || variable === "FALSE" )
        return true;

    if( variable === "0" )
        return true;

    if( !variable )
        return true;


    return false;
}

const getAllInput = function (form) {
    // Find disabled inputs, and remove the "disabled" attribute
    var disabled = form.find(':input:disabled').removeAttr('disabled');
    // serialize the form
    var formData = form.serializeArray();
    // re-disabled the set of inputs that you previously enabled
    disabled.attr('disabled','disabled');

    return formData;
}

const updateUrl = function(uri, title=null, data=null){
    var url = window.location.origin+uri;
    history.pushState(data, title, url);
}

const setSalesCycle = function (id) {
    return window.sales_cycle_id = id;
};

const setProject = function (id) {
    return window.project_id = id;
};

const setBusSeg = function (id) {
    return window.buss_seg_code = id;
};

const processAttachmentShow = function(el, res, holder, addholder=true, parent=null, showDelete=true){
    let image = el.find('.image-holder');
    let remove = el.find('.removephoto');

    if( res.is_image ) {
        image.css('background-image', 'url(' + res.url + ')')
        image.find('.add-text').remove();
        $(remove).attr('data-attach', res.id);
        $(image.parent()).attr('data-caption', res.filename);
        $(image.parent()).attr('data-fancybox', '');
        $(image.parent()).attr('href', res.url);
    }
    else{
        /*image.css('padding-top', '5%')*/
        image.find('.add-text').html('<i class="flaticon-file-2" style="font-size:1.7em;"></i> <br>' + res.filename);
        $(remove).attr('data-attach', res.id);
        $(image.parent()).attr('target', '_blank');
        $(image.parent()).attr('href', res.url);
    }

    if(showDelete)
        remove.show();

    el.find('.file-upload-input').remove();

    let borderDiv = image.closest('.attachment-border');

    // borderDiv.addClass('kt-margin-r-15');
    // borderDiv.css('width', '100%');

    borderDiv.removeClass('dashed-border-2');
    borderDiv.removeClass('attachment-border');

    if( addholder ) {
        if( !isFailed(parent) )
            holder = $(parent).find(holder);

        $(holder).append($('#photo-upload-template').html());
    }
}

const processAttachmentShowModal = function(el, res, holder, addholder=true, parent=null, showDelete=true){
    let image = el.find('.image-holder');
    let remove = el.find('.removephoto');

    if( res.is_image ) {
        image.css('background-image', 'url(' + res.url + ')')
        image.find('.add-text').remove();
        $(remove).attr('data-attach', res.id);
        $(image.parent()).attr('data-caption', res.filename);
        $(image.parent()).attr('data-fancybox', '');
        $(image.parent()).attr('href', res.url);
    }
    else{
        /*image.css('padding-top', '5%')*/
        image.find('.add-text').html('<i class="flaticon-file-2" style="font-size:1.7em;"></i> <br>' + res.filename);
        $(remove).attr('data-attach', res.id);
        $(image.parent()).attr('target', '_blank');
        $(image.parent()).attr('href', res.url);
    }

    if(showDelete)
    {
        remove.show();
        remove.css('width', '180px');
    }

    el.find('.file-upload-input').remove();

    let borderDiv = image.closest('.attachment-border');

    borderDiv.css('width', '180px');

    borderDiv.removeClass('dashed-border-2');

    if( addholder ) {
        if( !isFailed(parent) )
            holder = $(parent).find(holder);

        $(holder).append($('#photo-upload-template').html());
    }
}

const processAttachmentRemove = function(el){
    $(el).remove();
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend : function(jqXHR){
    },
    complete : function(){
        let ajaxlist = window.custmAjaxHolder;

        let looping = new Promise( async function (resolve, reject) {

            if( ajaxlist.length > 0 ) {
                await $.each(ajaxlist, function (index, value) {
                    if (!isFailed(value) && value.readyState == 4)
                        ajaxlist.splice(index, 1);
                });
            }
            resolve('done');
        });

        looping.then(function () {
            if( ajaxlist.length == 0 && !window.manualLoaderHide )
                hideLoader();
        });
    }
});

$(document).ajaxSend(function(ev, jqhr, settings) {

    let loaderDisable = false;
    if( typeof settings.beforeSend() !== 'undefined' ){
        if( typeof settings.beforeSend().loaderDisable !== "undefined" )
            loaderDisable = settings.beforeSend().loaderDisable;
    }

    if( !loaderDisable ) {
        showLoader();
        window.custmAjaxHolder.push(jqhr);
    }
});

const hideLoader = function(){
    $(".se-pre-con").fadeOut("slow");
};

const showLoader = function(){
    $(".se-pre-con").fadeIn("slow");
};

String.prototype.capitalize = function() {
    return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
};

const addThousandSeparatorOnkeyup = (parent= null) => {

    $(parent).keyup(function(event) {

        if(event.which >= 37 && event.which <= 40) return;

        this.value = window.thousandSeprator.on(this.value);
    });
}

const fileReader = function(input) {
    return new Promise(function (resolve, reject) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.DOMfile = input.files[0];
            let filepath = '';

            reader.onload = function(e) {
                resolve(e);
            }

            reader.readAsDataURL(input.files[0]);
        }
        else {
            reject('File Missing');
        }
    })
};

window.isValidURL = (str) => {
    const pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}

window.thousandSeprator = {
    on : (value) => {
        // value += '';
        // let x = value.split('.');
        // let x1 = x[0];
        // let x2 = x.length > 1 ? '.' + x[1] : '';
        // let rgx = /(\d+)(\d{3})/;
        // while (rgx.test(x1)) {
        //     x1 = x1.replace(rgx, '$1' + ',' + '$2');
        // }
        // return x1 + x2;

        var val = value.toString();
        val = val.replace(/[^0-9\.]/g,'');

        if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString('en');
            val = valArr.join('.');
        }

        return val;
    },
    off : (value) => {
        if( value.match(/\.\d{2}$/) ){
            value = string.replace(',', '');
        }

        return value;
    },
}

$(document).ready(function () {
    $('.sign-out-btn').on('click', function (e) {
        e.preventDefault();
        window.location.href = this.href +"/?nid=" + window.np_nid;
    });

    $('#subscription').on('click', function (e) {
        e.preventDefault();
        alert('Hello');
    });
	
});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
