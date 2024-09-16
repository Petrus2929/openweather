window.onload = function() {
    //get today's date in YYYY-MM-DD format
    var today = new Date().toISOString().split('T')[0];
    
    //setting the min attribute to today's date
    document.getElementById('date').setAttribute('min', today);
}
