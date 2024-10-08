setTimeout(() => {
    try {
        lalala;
    } catch (error) {
        alert("No se ejecutara");
        document.write("<p>error.name: "+error.name+"</p>");
        document.write("");
        document.write("");
    }
}, 1000);