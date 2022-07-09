var a = document.createElement('a');
a.href = 'index.html';
var image = document.getElementById('imgdiv').getElementsByTagName('img')[0];
b = a.appendChild(image);
document.getElementById('imgdiv').appendChild(a);