var ajax = new XMLHttpRequest();
  ajax.open("GET", "src/get_categories.php", true);
  ajax.send();
  var categories = [];
  
  ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
  
          for(var i = 0; i < data.length; i++) {
              categories[i] = data[i].category;
          }
  
      }
  };
  console.log(categories);
  var selectTest = document.getElementById('test_selection');
 function addCategories(){
    for(var i = 0; i < categories.length; i++) {
        var option = document.createElement("option");
        option.text = categories[i];
        option.value = categories[i];
        selectTest.add(option);
        
      }
 }
 window.setTimeout(addCategories,100);
 var selectedCategory = "All"; 
 function getSelectedCategory()
        {
             selectedCategory = selectTest.value;
             
        }
 function load(data){
    console.log(data);
 }
 function handleError(data){
    console.log(data);
}
 function passValue(){
    localStorage.setItem("textvalue",selectedCategory);
    sendRequest('./src/generate_category_test.php', { method: 'POST', data: `category=${selectedCategory}` }, load, handleError);
 }        



  
