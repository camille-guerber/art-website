$("#produit_imageFile_file").change(function (e) {
    e.preventDefault();
    var fileReader = new FileReader();
    let file =  $('#produit_imageFile_file').prop('files')[0];
    let preview = $('#uploaded-img-1');
    let previewLabel = $('#label-img-1');

    if (/\.(jpe?g|png)$/i.test(file.name)) {
        fileReader.onload = function (e) {
            preview.attr('src', e.target.result);
            previewLabel.empty();
            previewLabel.append(file.name);
        };
        fileReader.readAsDataURL(file);
    } else {
        alert('Format invalide (png, jpg');
    }
});

$("#produit_imageFile2_file").change(function (e) {
    e.preventDefault();
    var fileReader = new FileReader();
    let file =  $('#produit_imageFile2_file').prop('files')[0];
    let preview = $('#uploaded-img-2');
    let previewLabel = $('#label-img-2');

    if (/\.(jpe?g|png)$/i.test(file.name)) {
        fileReader.onload = function (e) {
            preview.attr('src', e.target.result);
            previewLabel.empty();
            previewLabel.append(file.name);
        };
        fileReader.readAsDataURL(file);
    } else {
        alert('Format invalide (png, jpg');
    }
});

$("#produit_imageFile3_file").change(function (e) {
    e.preventDefault();
    var fileReader = new FileReader();
    let file =  $('#produit_imageFile3_file').prop('files')[0];
    let preview = $('#uploaded-img-3');
    let previewLabel = $('#label-img-3');

    if (/\.(jpe?g|png)$/i.test(file.name)) {
        fileReader.onload = function (e) {
            preview.attr('src', e.target.result);
            previewLabel.empty();
            previewLabel.append(file.name);
        };
        fileReader.readAsDataURL(file);
    } else {
        alert('Format invalide (png, jpg');
    }
});