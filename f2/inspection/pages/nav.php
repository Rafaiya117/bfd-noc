<style>
    #breadcrumb {
  padding: 10px;
  background-color: #f5f5f5;
  display: flex;
  align-items: center;
}

#crumbTrail {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

#crumbTrail li {
  display: inline-block;
  margin-right: 10px;
}

#crumbTrail a {
  text-decoration: none;
  color: #333;
}

</style>
<body>
    <div id="breadcrumb">
        <ol id="crumbTrail">
        </ol>
    </div>
      
</body>

<script>
  const breadcrumb = document.getElementById("breadcrumb");
const crumbTrail = document.getElementById("crumbTrail");

const url = window.location.pathname;
const breadcrumbItems = [];

// Extract the breadcrumb items from the URL
const parts = url.split("->");
for (let i = 0; i < parts.length; i++) {
  let link = "";
  for (let j = 0; j <= i; j++) {
    link += "/" + parts[j];
  }
  breadcrumbItems.push({ name: parts[i], link: link });
}

// Generate the HTML for the breadcrumb trail
let crumbHTML = "";
breadcrumbItems.forEach(item => {
  crumbHTML += `<li><a href="${item.link}">${item.name}</a></li>`;
});
crumbTrail.innerHTML = crumbHTML;



</script>