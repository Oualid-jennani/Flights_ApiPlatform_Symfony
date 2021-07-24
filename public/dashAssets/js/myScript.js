(function($) {

    function ImageCount() {
        var count = $('#ImageList').children().length;

        if(count-1 >= 5){
            $('#inpImage').hide();
        }else{
            $('#inpImage').show();
        }
        console.log(count);
    }
    ImageCount();

    $('.deleteImg').click(function () {
        $(this).parent().remove();
    })

})(jQuery);


//---------------------------------------------------------------------------------------

//-------- href delete -------------
function deleteAction(link) {
    document.getElementById("linkDelete").href = link;
}
//-------- href delete -------------


//--------------- edit menu ----------------------
var pos = 0,newPos = 0;
var deleteImg = document.getElementsByClassName("deleteImg");
var divFiles = document.getElementById("divFiles");
var ImageList = document.getElementById("ImageList");
var newPic = document.getElementsByClassName('newPic');
var newFile = document.getElementsByClassName('newFile');


var reader = [];
for(var i = 0 ; i < 5 ; i++){
    reader.push(new FileReader());
}

function previewFile() {
    pos = newPos;
    reader[pos].onloadend = function () {

        $('<div class="newPic">' +
            '<button type="button" class="close deleteFile" onclick="deleteFile('+pos+')">&times;</button>' +
            '<img src="' + reader[pos].result + '">' +
            '</div>').insertBefore($('.files'));

    }
    reader[pos].readAsDataURL(document.getElementsByClassName('newFile')[pos].files[0]);


    $('#divFiles').append('<input type="file" name="pic[]" class="newFile" onchange="previewFile()" accept="image/*">')

    newPos++;

}

function deleteFile(del) {
    newPic[del].remove();
    newFile[del].remove();
    newPos--;
}

function inputClick() {
    newFile[newPos].click();
}

//--------------- edit menu ----------------------

