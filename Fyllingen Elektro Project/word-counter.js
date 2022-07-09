function c_count(obj){
    var maxLength = 180;
    var strLength = obj.value.length;

    if(strLength > maxLength) {
        document.getElementById("word_count").innerHTML = '<span style="color: red;">'+strLength+' / '+maxLength+ '</span>';
    }else{
        document.getElementById("word_count").innerHTML = strLength+' / '+maxLength;
    }
}