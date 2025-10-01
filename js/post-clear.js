// Phase 2 - JavaScript

// Clear Button
let clearButton = document.getElementById("clear");

clearButton.onclick = function(e) {
    if (!window.confirm("Are you sure you want to clear?"))
        e.preventDefault();
}



// Post Button
let postButton = document.getElementById("post");

postButton.onclick = function(e) {    
    let title = document.getElementById("title-input");
    let blog = document.getElementById("blog-input");
    if (title.value.trim() == "" && blog.value.trim() == "") {
        e.preventDefault();
        title.style.border = "solid 1pt red";
        blog.style.border = "solid 1pt red";
    }
    else if (title.value.trim() == "") {
        e.preventDefault();
        title.style.border = "solid 1pt red";
        blog.style.border = "none";
    }
    else if (blog.value.trim() == "") {
        e.preventDefault();
        blog.style.border = "solid 1pt red";
        title.style.border = "none";
    }
}