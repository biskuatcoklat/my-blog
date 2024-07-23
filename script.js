let menu = document.querySelector("#menu-bars");
let navbar = document.querySelector(".navbar");

menu.onclick = () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
  searchIcon.classList.remove("fa-times");
  searchForm.classList.remove("active");
};

let searchIcon = document.querySelector("#search-icon");
let searchForm = document.querySelector(".search-form");

searchIcon.onclick = () => {
  searchIcon.classList.toggle("fa-times");
  searchForm.classList.toggle("active");
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
};

window.onscroll = () => {
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
  searchIcon.classList.remove("fa-times");
  searchForm.classList.remove("active");
};

document.getElementById("search-box").addEventListener("input", function () {
  let query = this.value;

  // Update the posts section with search results
  fetch(window.location.href + "?query=" + encodeURIComponent(query))
    .then((response) => response.json())
    .then((data) => {
      let postsContainer = document.querySelector(".posts-container");
      postsContainer.innerHTML = ""; // Clear previous results

      data.forEach((post) => {
        let postElement = document.createElement("div");
        postElement.classList.add("post");

        postElement.innerHTML = `
                    <a href="#"><img src="/cms/controller/img/${post.foto}" alt="" class="image"></a>
                    <div class="date">
                        <i class="far fa-clock"></i>
                        <span>${post.created_at}</span>
                    </div>
                    <h3 class="title">${post.title}</h3>
                    <p class="text">${post.content} <a href="judul 1.html" style="color: blue;"><u>Berikut penjelasan</u></a> </p>
                    <div class="links">
                        <a href="#" class="user">
                            <i class="far fa-user"></i>
                            <span>by ${post.author}</span>
                        </a>
                        <a href="#" class="icon">
                            <i class="far fa-calender"></i>
                            <span>${post.created_at}</span>
                        </a>
                    </div>
                `;

        postsContainer.appendChild(postElement);
      });
    });
});
