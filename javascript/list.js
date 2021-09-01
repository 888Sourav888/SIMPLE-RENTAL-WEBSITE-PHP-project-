function listValidate(){
   
    var name = document.getElementById('name');   
    var type = document.getElementById('type');   
    var sqft = document.getElementById('sqft');   
    var expiry = document.getElementById('expiry');   
    var street = document.getElementById('street');   
    var area = document.getElementById('area');   
    var pincode = document.getElementById('pincode');   
    var city = document.getElementById('city');   
    var state = document.getElementById('state');   
    var country = document.getElementById('country');
    var price = document.getElementById('price') ; 

    
    //Resetting all the border of the input fields 
    var array = [name , type , sqft , expiry , street ,tenants, area , pincode , city ,state ,country,price] ;
    for(var i = 0 ; i<array.length ; i++){
        array[i].style.border= '1px solid black' ;
    } 
    if(name.value.length == 0){
        name.style.border = '2px solid red' ; 
        alert('Please Enter the name of the property');
        return false ;
    }
    if(type.value.length == 0){
        type.style.border = '2px solid red' ; 
        alert('Please Enter the type of the property');
        return false ;
    }
    if(sqft.value.length == 0){
        sqft.style.border = '2px solid red' ; 
        alert('Please Enter the sqft of the property');
        return false ;
    }
    if(price.value.length == 0){
        price.style.border = '2px solid red' ; 
        alert('Please Enter the price of the property') ; 
        return false ; 
    }
    if(expiry.value.length == 0){
        expiry.style.border = '2px solid red' ; 
        alert('Please Set an expiry date for the property');
        return false ;
    } 
    if(street.value.length == 0){
        street.style.border = '2px solid red' ; 
        alert('Please Enter the street in which the property is there!');
        return false ;
    }
    if(area.value.length == 0){
        area.style.border = '2px solid red' ; 
        alert('Please Enter the area in which the property is there');
        return false ;
    }
    if(pincode.value.length == 0){
        pincode.style.border = '2px solid red' ; 
        alert('Please Enter the pincode of the area in which property is there');
        return false ;
    } 
    if(city.value.length == 0){
        city.style.border = '2px solid red' ; 
        alert('Please Enter the city in which the property is there');
        return false ;
    } 
    
    if(state.value.length == 0){
        state.style.border = '2px solid red' ; 
        alert('Please Enter the State/Province in which the property is there');
        return false ;
    } 
    if(country.value.length == 0){
        country.style.border = '2px solid red' ; 
        alert('Please Enter the Country in which the property is there');
        return false ;
    } 
    return true  ; 
}