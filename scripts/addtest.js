(function() {
    /**
     * Get the logout button
     */
    var logoutBtn = document.getElementById('logout');
    /**
     * Listen for click event on the logout button
     */
    logoutBtn.addEventListener('click', logout);
})();

/**
 * Handle the click event by sending an asynchronous request to the server
 * @param {*} event
 */
function logout(event) {
    /**
     * Prevent the default behavior of the clicking the form submit button
     */
    event.preventDefault();

    /**
     * Send GET request to api.php/logout to logout the user
     */
    sendRequest('src/logout.php', { method: 'GET' }, redirect, handleError);
}

function redirect() {
    window.location = './login.html';
}

function handleError(errors) {
    window.location = './login.html';
}
      