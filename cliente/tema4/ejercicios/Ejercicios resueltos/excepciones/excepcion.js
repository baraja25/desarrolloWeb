function BaseException(message = "Default Message", fileName, lineNumber)
{
 let instance = new Error(message, fileName, lineNumber);
 instance.name = "MyError";
 Object.setPrototypeOf(instance, Object.getPrototypeOf(this));
 if (Error.captureStackTrace) {
 Error.captureStackTrace(instance, BaseException);
 }
 return instance;
}
BaseException.prototype = Object.create(Error.prototype, {
 constructor: {
 value: BaseException,
 enumerable: false,
 writable: true,
 configurable: true
 }
});
//Excepción acceso inválido a constructor
function InvalidAccessConstructorException() {
 let instance = BaseException.call(this, "Constructor cant be called as a function.");
 instance.name = "InvalidAccessConstructorException";
 return instance;
}
InvalidAccessConstructorException.prototype = Object.create(BaseException
.prototype);
InvalidAccessConstructorException.prototype.constructor = InvalidAccessCo
nstructorException;
//Excepción personalizada para indicar valores vacios.
function EmptyValueException(param) {
 let instance = BaseException.call(this, "Error: The parameter " + param
+ " can't be empty.");
 instance.name = "EmptyValueException";
 instance.param = param;
 return instance;
}
EmptyValueException.prototype = Object.create(BaseException.prototype);
EmptyValueException.prototype.constructor = EmptyValueException;
//Excepción de valor inválido
function InvalidValueException(param, value) {
 let instance = BaseException.call(this, "Error: The paramenter " + param + " has an invalid value. (" + param + ": " + value + ")");
 instance.name = "InvalidValueException";
 instance.param = param;
 instance.param = value;
 return instance;
}
InvalidValueException.prototype = Object.create(BaseException.prototype);
InvalidValueException.prototype.constructor = InvalidValueException;