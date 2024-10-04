const str = 'En un lugar de la mancha';
const reg1 = /mancha/;
const reg2 = /España/;
const emailRegex = ;
document.write("<p>"+reg1.test(str)+"</p>");
document.write("<p>"+reg2.test(str)+"</p>");
document.write("<p> Expresion: ");



let miArray1 = reg1.exec(str);
let miArray2 = emailRegex.exec("prueba@gmail.com");