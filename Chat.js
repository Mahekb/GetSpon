document.getElementById("log1").style.display = "none";
document.getElementsByClassName('tab')[0]
        .addEventListener('click', function (event) {
            alert('Hey');
            document.getElementById("log2").style.display = "none";
            document.getElementById("log1").style.display = "block";
        });
function back(){
    document.getElementById("log1").style.display = "none";
    document.getElementById("log2").style.display = "block";
}