let book = {
    ISBN: "978-84-9804-654-0",
    title: "El Quijote",
    author: "Miguel de Cervantes",
    publicationDate: new Date(1605, 0, 1),
    price: 20,
};

let book2 = {
    ISBN: "978-84-9804-654-0",
    title: "lol",
    author: "Miguel de Cervantes",
    publicationDate: new Date(1605, 0, 1),
    price: 20,
};

function create() {
    return [];
}

function isEmpty(list) {
    return list.length === 0;
}

function isFull(list) {
    return list.length >= MAXCAPACITY;
}

function size(list) {
    return list.length;
}

function add(list, book) {
    return list.push(book);
}

function addAt(list, book, index) {
    list.splice(index, 0, book);
    return list.length;
}

function get(list, index) {
    
}

const MAXCAPACITY = 10;
lista = create();

a = add(lista, book);
a = add(lista, book);
a = add(lista, book);
a = add(lista, book);
a = add(lista, book);
a = add(lista, book);

b = addAt(lista, book2, 0);
console.log(b)


