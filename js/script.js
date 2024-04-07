const btnTogglePasswordField = document.querySelectorAll(".password-toggle");

btnTogglePasswordField.forEach((item) => {
  item.addEventListener("click", () => {
    const attri = item.parentNode.firstElementChild.getAttribute("type");
    if (attri === "password") {
      item.parentNode.firstElementChild.setAttribute("type", "text");
    } else {
      item.parentNode.firstElementChild.setAttribute("type", "password");
    }
  });
});


//job count

let jobTable = document.getElementById("jobTable");


let tbodyRowCount = jobTable.tBodies[0].rows.length;

document.getElementById("totalJobs").innerHTML= tbodyRowCount;

//bikes count

let bikeTable = document.getElementById("bikeTable");


let bikeRowCount = bikeTable.tBodies[0].rows.length;

document.getElementById("totalBikes").innerHTML= bikeRowCount;

console.log(bikeRowCount);




