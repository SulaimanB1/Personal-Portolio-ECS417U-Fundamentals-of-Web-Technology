// Phase 2 - JavaScript

// Select Blog Submit Button
let selectBlogSubmitButton = document.getElementById("select-blog-submit");

selectBlogSubmitButton.onclick = function(e) {  
    let blogID = document.getElementById("blogID-select");
    if (blogID.value == "") {
        e.preventDefault();
        blogID.style.border = "solid 1pt red";
    }
}

// Comment Post Button
let commentPostButton = document.getElementById("post-comment");

commentPostButton.onclick = function(e) {  
    let comment = document.getElementById("comment-input");
    if (comment.value == "") {
        e.preventDefault();
        comment.style.border = "solid 1pt red";
    }
}