function deleteBlogClicked(bid) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location.href = "blogs.php";
            }
        };
        xmlhttp.open("GET", "deleteBlog.php?bid=" + bid, true);
        xmlhttp.send();
    }
