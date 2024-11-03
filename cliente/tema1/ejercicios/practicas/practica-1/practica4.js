function isBook(elem) {
    const isbnPattern = /^(97(8|9))?\d{9}(\d|X)$/; // Expresión regular para ISBN
    return elem && typeof elem.ISBN === 'string' && typeof elem.title === 'string' && isbnPattern.test(elem.ISBN);
  }