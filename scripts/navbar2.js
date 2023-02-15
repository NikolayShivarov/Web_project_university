var navbar;

(function() {
    /**
     * Get the register button
     */
    // var register = document.getElementById('register');
  
    // /**
    //  * Listen for click event on the register button
    //  */
    // register.addEventListener('click', sendForm);
    navbar = document.getElementById('nav');
    sendRequest('./is_admin.php', { method: 'GET', data: `category=All` }, load, err);
})();

function load(data){
    if(data['isadmin'] == 1){
        var li = document.createElement("li");
        var a = document.createElement('a');
        a.innerHTML = "Manage questions";
        a.href = './show_questions.php';
        li.appendChild(a);
        navbar.appendChild(li);
        var li = document.createElement("li");
        var a = document.createElement('a');
        a.innerHTML = "Import Questions";
        a.href = '../addtest.php';
        li.appendChild(a);
        navbar.appendChild(li);
        var li = document.createElement("li");
        var a = document.createElement('a');
        a.innerHTML = "Export Questions";
        //a.href = './addtest.php';
        li.appendChild(a);
        navbar.appendChild(li);
    }
}

function err(){

}