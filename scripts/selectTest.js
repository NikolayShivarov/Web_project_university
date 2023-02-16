var ajax = new XMLHttpRequest();
ajax.open("GET", "./src/get_fn.php", true);
ajax.send();
var fn = [];
  
ajax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        console.log(data);
        for(var i = 0; i < data.length; i++) {
            fn[i] = data[i].fn;
        }

    }
};

console.log(fn);
var selectTest = document.getElementById('test_fn');

function addFn(){
    for(var i = 0; i < fn.length; i++) {
        var option = document.createElement("option");
        option.text = fn[i];
        option.value = fn[i];
        selectTest.add(option);
        
    }
}

window.setTimeout(addFn,100);
var selectedFn = "All"; 

function load(data){
    console.log(data);
}
function handleError(data){
    console.log(data);
}
    
var btn = document.getElementById('start_test_button');

btn.onclick = function (event){
    event.preventDefault();
    var maxQ = document.getElementById('ratenum1').value;
    var dificulty = document.getElementById('ratenum2').value;
    selectedFn = selectTest.value;
    localStorage.setItem("fnNum",selectedFn);
    localStorage.setItem("maxQ",maxQ);
    localStorage.setItem("dificulty",dificulty);
    window.location = './test.php';
}        



  
