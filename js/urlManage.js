const btnUrl = document.querySelectorAll(".select-invoice");
const btnProfile = document.querySelectorAll(".profile_image");
const btnJobsPages = document.querySelectorAll(".mechanic-select");
const btnAdminJob = document.querySelectorAll(".select-admin-job");
const btnProfileIcon = document.querySelectorAll(".profile-icon-edit");
const btnCloseJobProcessingModal = document.querySelector(
  ".close-modal-job-processing"
);
const btnSelectAdminMechanic = document.querySelectorAll(
  ".select-admin-mechanic"
);

const btnEditMechanicData = document.querySelectorAll(".edit-mechanic-data");
const btnMechanicJobDone = document.querySelectorAll(".select-admin-job--2");
const btnSelectCustomerToDelete = document.querySelectorAll(
  ".delete-customer-data"
);
const btnSelectAdminCustomer = document.querySelectorAll(
  ".select-admin-customer"
);

const modalJobProcessing = document.querySelector(".modal-job-processing");
const overlayModalJobProcessing = document.querySelector(
  ".overlay-job-processing"
);

const modalJobDone = document.querySelector(".modal-job-done");
const overlayJobDone = document.querySelector(".overlay-job-done");

const openAndCloseModalJobProcessing = function () {
  modalJobProcessing.classList.toggle("hidden-job-processing");
  overlayModalJobProcessing.classList.toggle("hidden-job-processing");
};

const openAndCloseModalJobDone = function () {
  modalJobDone.classList.toggle("hidden-job-done");
  overlayJobDone.classList.toggle("hidden-job-done");
};

btnUrl.forEach((location) =>
  location?.addEventListener("click", (e) => {
    window.location.href = "jobs-invoice.html";
  })
);

btnProfile.forEach((location) =>
  location?.addEventListener("click", () => {
    window.location.href = "profile.php";
  })
);

// Responsible for mechanic dashboard

btnJobsPages.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();
    const status = item.children[6].children[0].textContent;
    if (status === "Present") {
      window.location.href = "present.html";
    } else if (status === "Absent") {
      window.location.href = "absent.html";
    } else {
      return null;
    }
  });
});

// Profile page edit
// btnProfileIcon.forEach((item) => {
//   item.addEventListener("click", () => {
//     window.location.href = "profile-edit.html";
//   });
// });

// for admin dashboard
btnAdminJob.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();
    const status = item.children[7].children[0].textContent;
    if (status === "Processing") {
      openAndCloseModalJobProcessing();
    } else if (status === "Job Done") {
      openAndCloseModalJobDone();
    } else {
      return null;
    }
  });
});

btnCloseJobProcessingModal?.addEventListener(
  "click",
  openAndCloseModalJobProcessing
);

overlayJobDone?.addEventListener("click", openAndCloseModalJobDone);

// admin select mechanic
btnSelectAdminMechanic.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();

    window.location.href = "mechanic.html";
  });
});

btnEditMechanicData.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();

    window.location.href = "editmechanic.html";
  });
});

btnMechanicJobDone.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();
    const status = item.children[6].children[0].textContent;
    if (status === "Processing") {
      openAndCloseModalJobProcessing();
    } else if (status === "Job Done") {
      openAndCloseModalJobDone();
    } else {
      return null;
    }
  });
});

// admin select customer
btnSelectAdminCustomer.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();

    window.location.href = "customerselect.html";
  });
});

// apointment manage availability
const btnManageAvailability = document.querySelector(".manageavailability");
btnManageAvailability?.addEventListener("click", () => {
  window.location.href = "manageavailability.html";
});

const btnViewAllCustomerJobs = document.querySelector(
  ".customers-view-all-jobs-btn"
);
btnViewAllCustomerJobs?.addEventListener("click", () => {
  window.location.href = "jobs.html";
});
const btnViewAllCustomerBikes = document.querySelector(
  ".customers-view-all-bikes-btn"
);
btnViewAllCustomerBikes?.addEventListener("click", () => {
  window.location.href = "bikes.html";
});

const btnViewAllAdminAppointment = document.querySelector(
  ".btn-view-all-apointment"
);

btnViewAllAdminAppointment?.addEventListener("click", () => {
  window.location.href = "appointments.html";
});

const btnViewAllAdminJobs = document.querySelector(".btn-view-all-admin-jobs");

btnViewAllAdminJobs?.addEventListener("click", () => {
  window.location.href = "jobs.html";
});
