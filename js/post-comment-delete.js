// Phase 2 - JavaScript

// Select Blog Delete Button
let selectBlogDeleteButton = document.getElementById("select-blog-delete");

selectBlogDeleteButton.onclick = function(e) {  
    let blogID = document.getElementById("blogDelete-select");
    if (blogID.value == "") {
        e.preventDefault();
        blogID.style.border = "solid 1pt red";
    }
}


// Comment Delete Button
let commentDeleteButton = document.getElementById("select-comment-delete");

commentDeleteButton.onclick = function(e) {  
    let comment = document.getElementById("commentDelete-select");
    if (comment.value == "") {
        e.preventDefault();
        comment.style.border = "solid 1pt red";
    }
}