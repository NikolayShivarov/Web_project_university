var ajax = new XMLHttpRequest();
  ajax.open("GET", "../src/get_fn.php", true);
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
 function getSelectedFn()
        {
             selectedFn = selectTest.value;
             
        }
 function load(data){
    console.log(data);
 }
 function handleError(data){
    console.log(data);
}
 function passValue(){
    localStorage.setItem("textvalue",selectedFn);
    window.location = './test.php';
 }        