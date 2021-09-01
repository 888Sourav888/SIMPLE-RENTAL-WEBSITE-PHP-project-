function loginValidation(){
    var mail = document.getElementById('email') ; 
    var error = document.getElementById('error') ; 
    var pass = document.getElementById('pass') ; 
    error.innerHTML ="" ; 
    error.style.display='none ' ;
    mail.style.boxShadow = 'none' ; 
    pass.style.boxShadow = 'none' ; 
    if(mail.value.length == 0){
        error.style.display='block' ;
        mail.style.boxShadow = '2px 2px 10px red' ; 
        mail.placeholder='Please Enter an email' ;
        error.innerHTML = 'You have not entered an email' ;
        return false; 
    }
    if(!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail.value))){
		mail.style.boxShadow = '2px 2px 10px red' ; 
        mail.value = "" ;
        mail.placeholder='Please Enter an valid email' ;
        error.innerHTML = 'A valid email id should be entered!' ;
        error.style.display='block' ; 
		return false ; 
	}
    if(pass.value.length == 0){
        pass.style.boxShadow = '2px 2px 10px red' ;
        pass.placeholder='Please Enter a password' ;
        error.innerHTML = 'You have not entered the password' ;
        error.style.display='block' ;
        return false ; 
    }
    
    return true;
}

function registerValidation(){
    //getting the handler for every input field 
    var err = document.getElementById('err') ; 
    var fname = document.getElementById('fnm') ; 
    var lname = document.getElementById('lname') ; 
    var age = document.getElementById('age') ; 
    var date = document.getElementById('date') ; 
    var mail = document.getElementById('email') ; 
    var pass = document.getElementById('pass') ; 
    var repass = document.getElementById('repass') ; 
    var phone  = document.getElementById('phone') ; 
    var state = document.getElementById('state') ; 
    var city = document.getElementById('city') ; 
    //Setting all the error displayer to default state 
    fname.style.boxShadow = 'none' ;
    lname.style.boxShadow = 'none' ; 
    age.style.boxShadow = 'none' ; 
    date.style.boxShadow = 'none' ;  
    mail.style.boxShadow = 'none' ;  
    pass.style.boxShadow = 'none' ;  
    repass.style.boxShadow = 'none' ;   
    phone.style.boxShadow = 'none';
    state.style.boxShadow = 'none' ;
    city.style.boxShadow = 'none' ; 
    //Main validation if statements start here 
    if(fname.value.length == 0){
        fname.placeholder = 'Enter firstname' ; 
        fname.style.boxShadow = '2px 2px 10px red';
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the firstname' ;
        return false;
    }
    if(lname.value.length == 0){
        lname.placeholder = 'Enter lastname' ; 
        lname.style.boxShadow = '2px 2px 10px red';
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the lastname' ; 
        return false ;
    }
    if(age.value.length == 0){
        age.placeholder = 'Enter age' ; 
        age.style.boxShadow = '2px 2px 10px red';
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the age' ; 
        return false ;
    }
    if(date.value.length == 0){
        date.style.boxShadow = '2px 2px 10px red' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the date of birth' ; 
        return false ; 
    }
    if(mail.value.length == 0){
        mail.style.boxShadow = '2px 2px 10px red' ; 
        mail.placeholder = 'Enter email' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the email' ; 
        return false ; 
    }
    if(!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail.value))){
        mail.style.boxShadow = '2px 2px 10px red' ; 
        mail.value = ""  ;
        mail.placeholder = 'Enter a vaild email' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter valid email' ; 
        return false ; 
    }
    if(phone.value.length == 0){
        phone.style.boxShadow = '2px 2px 10px red' ; 
        phone.placeholder = 'Enter phone number' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter phone number' ; 
        return false ; 
    }
    if(!(/^\d{10}$/.test(phone.value))){
        phone.style.boxShadow = '2px 2px 10px red' ; 
        phone.placeholder = 'Enter valid phone number' ; 
        phone.value = "" ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter valid phone  number' ; 
        return false ;
    }

    if(state.value.length == 0){
        state.style.boxShadow = '2px 2px 10px red' ; 
        state.placeholder = 'Enter your state' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the name of state you live in' ; 
        return false ;
    }
    if(city.value.length == 0){
        city.style.boxShadow = '2px 2px 10px red' ; 
        city.placeholder = 'Enter your city' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the name of city you live in' ; 
        return false ;
    }

    if(pass.value.length == 0){
        pass.style.boxShadow = '2px 2px 10px red' ; 
        pass.placeholder = 'Enter password' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Enter the password' ; 
        return false ; 
    }
    if(repass.value.length == 0){
        repass.style.boxShadow = '2px 2px 10px red' ; 
        repass.placeholder = 'Enter password' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Retype the password' ; 
        return false ; 
    }
    if(pass.value != repass.value){
        repass.value = ""  ;
        repass.style.boxShadow = '2px 2px 10px red' ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Entered Password do not match!' ; 
        return false ; 
    }
    if(pass.value == 'password' || pass.value == 'Password'){
        pass.value = "" ; 
        repass.value = "" ; 
        err.style.display = 'block' ; 
        err.innerHTML = 'Do not have such a stupid password xD ' ;
        return false ;
    }
    return true;
}
