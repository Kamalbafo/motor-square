"use strict";

const modal = document.querySelector(".modal");
const modalDelete = document.querySelector(".modal-delete");
const modalDeleteConfirm = document.querySelector(".modal-delete-confirm");
const modalAddNewBike = document.querySelector(".modal-add-new-bike");
const modalBikeAddedConfirm = document.querySelector(
  ".modal-bike-added-confirm"
);
const modalBookNewJob = document.querySelector(".modal-new-job");
const modalFinishJob = document.querySelector(".modal-finish-new-job");
const modalInvoice = document.querySelector(".modal-invoice");
const modalInvoiceConfirm = document.querySelector(".modal-invoice-confirm");
const modalNotification = document.querySelector(".modal-notification");

const overlay = document.querySelector(".overlay");
const overlayDelete = document.querySelector(".overlay-delete");
const overlayDeleteConfirm = document.querySelector(".overlay-delete-confirm");
const overlayAddNewBike = document.querySelector(".overlay-add-new-bike");
const overlayBikeAdded = document.querySelector(".overlay-bike-added-confirm");
const overlayBookNewJob = document.querySelector(".overlay-new-job");
const overlayFinishNewJob = document.querySelector(".overlay-finish-new-job");
const overlayInvoice = document.querySelector(".overlay-invoice");
const overlayInvoiceConfirm = document.querySelector(
  ".overlay-invoice-confirm"
);
const overlayNotification = document.querySelector(".overlay-notification");

const btnCLoseModal = document.querySelector(".close-modal");
const btnOpenModal = document.querySelector(".show-link-modal");
const btnOpenModalPassword = document.querySelector(".show-password-modal");
const deleteDataModal = document.querySelectorAll(".delete-data");
const cancelDeleteModal = document.querySelector(".cancel-delete-modal");
const confirmDeleteButton = document.querySelector(".confirm-delete");
const finishedButtonDelete = document.querySelector(".finish-delete");
const addNewBikeButton = document.querySelector(".add-new-bike");
const btnCloseModalAddNewBike = document.querySelector(
  ".close-modal-add-new-bike"
);
const confirmAddNewBike = document.querySelector(".confirm-add-new-bike");
const btnFinishedBikeAdded = document.querySelector(".finish-bike-added");
const btnBookNewJob = document.querySelector(".book-new-job");
const btnCloseModalAddNewJob = document.querySelector(
  ".close-modal-add-new-job"
);
const btnConfirmAddNewJob = document.querySelector(".confirm-add-new-job");
const btnConfirmFinishedNewJob = document.querySelector(".finish-new-job");
const btnInvoiceGen = document.querySelector(".generate-invoice");
const btnConfirmInvoice = document.querySelector(".save-invoice");
const btnInvoiceConfirmFinished = document.querySelector(".invoice-confirm");
const btnNotification = document.querySelector(".fa-bell");

const openModal = function () {
  // console.log('Button clicked');
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

const openModalDelete = function () {
  modalDelete.classList.remove("hidden-delete");
  overlayDelete.classList.remove("hidden-delete");
};

const openModaldeleteConfirm = function () {
  modalDeleteConfirm.classList.remove("hidden-delete-confirm");
  overlayDeleteConfirm.classList.remove("hidden-delete-confirm");
};

const openModalAddNewBike = function () {
  modalAddNewBike.classList.remove("hidden-add-new-bike");
  overlayAddNewBike.classList.remove("hidden-add-new-bike");
};

const openModalBikeAddedConfirm = function () {
  modalBikeAddedConfirm.classList.remove("hidden-bike-added-confirm");
  overlayBikeAdded.classList.remove("hidden-bike-added-confirm");
};

const openNewJobModal = function () {
  modalBookNewJob.classList.remove("hidden-new-job");
  overlayBookNewJob.classList.remove("hidden-new-job");
};

const openFinishedNewJobModal = function () {
  modalFinishJob.classList.remove("hidden-finish-new-job");
  overlayFinishNewJob.classList.remove("hidden-finish-new-job");
};

const openModalinvoice = function () {
  modalInvoice.classList.remove("hidden-invoice");
  overlayInvoice.classList.remove("hidden-invoice");
};

const openModalInvoiceConfirm = function () {
  modalInvoiceConfirm.classList.remove("hidden-invoice-confirm");
  overlayInvoiceConfirm.classList.remove("hidden-invoice-confirm");
};

const openNotificationModal = function () {
  modalNotification.classList.remove("hidden-notification");
  overlayNotification.classList.remove("hidden-notification");
};

btnOpenModal?.addEventListener("click", (e) => {
  e.preventDefault();
  openModal();
});

document.addEventListener("DOMContentLoaded", () => {
  btnOpenModalPassword?.addEventListener("click", (e) => {
    e.preventDefault();
    openModal();
  });
});

deleteDataModal.forEach((mo, i) =>
  mo.addEventListener("click", (e) => {
    e.preventDefault();
    openModalDelete();
  })
);

addNewBikeButton?.addEventListener("click", openModalAddNewBike);
btnBookNewJob?.addEventListener("click", openNewJobModal);
btnInvoiceGen?.addEventListener("click", openModalinvoice);
btnNotification?.addEventListener("click", openNotificationModal);

// btnOpenModalPassword.addEventListener("click", () => alert("you"));

const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

const closeModalDelete = function () {
  modalDelete.classList.add("hidden-delete");
  overlayDelete.classList.add("hidden-delete");
};

const closeModalDeleteConfirm = function () {
  modalDeleteConfirm.classList.add("hidden-delete-confirm");
  overlayDeleteConfirm.classList.add("hidden-delete-confirm");
};

const closeModalAddNewBike = function () {
  modalAddNewBike.classList.add("hidden-add-new-bike");
  overlayAddNewBike.classList.add("hidden-add-new-bike");
};

const closeModalBikeAddedConfirm = function () {
  modalBikeAddedConfirm.classList.add("hidden-bike-added-confirm");
  overlayBikeAdded.classList.add("hidden-bike-added-confirm");
};

const closeNewJobModal = function () {
  modalBookNewJob.classList.add("hidden-new-job");
  overlayBookNewJob.classList.add("hidden-new-job");
};

const closeFinishedNewJobModal = function () {
  modalFinishJob.classList.add("hidden-finish-new-job");
  overlayFinishNewJob.classList.add("hidden-finish-new-job");
};

const closeModalinvoice = function () {
  modalInvoice.classList.add("hidden-invoice");
  overlayInvoice.classList.add("hidden-invoice");
};

const closeModalInvoiceConfirm = function () {
  modalInvoiceConfirm.classList.add("hidden-invoice-confirm");
  overlayInvoiceConfirm.classList.add("hidden-invoice-confirm");
};

const closeNotificationModal = function () {
  modalNotification.classList.add("hidden-notification");
  overlayNotification.classList.add("hidden-notification");
};

confirmDeleteButton?.addEventListener("click", () => {
  closeModalDelete();
  openModaldeleteConfirm();
});
btnConfirmAddNewJob?.addEventListener("click", () => {
  closeNewJobModal();
  openFinishedNewJobModal();
});

btnCloseModalAddNewBike?.addEventListener("click", closeModalAddNewBike);

btnCLoseModal?.addEventListener("click", closeModal);
cancelDeleteModal?.addEventListener("click", closeModalDelete);
finishedButtonDelete?.addEventListener("click", closeModalDeleteConfirm);
confirmAddNewBike?.addEventListener("click", () => {
  closeModalAddNewBike();
  openModalBikeAddedConfirm();
});
btnCloseModalAddNewJob?.addEventListener("click", closeNewJobModal);
btnFinishedBikeAdded?.addEventListener("click", closeModalBikeAddedConfirm);
btnConfirmFinishedNewJob?.addEventListener("click", closeFinishedNewJobModal);
btnConfirmInvoice?.addEventListener("click", () => {
  closeModalinvoice();
  openModalInvoiceConfirm();
});

btnInvoiceConfirmFinished?.addEventListener("click", () => {
  closeModalInvoiceConfirm();
  window.location.href = "present2.html";
});

overlay?.addEventListener("click", closeModal);
overlayInvoice?.addEventListener("click", closeModalinvoice);
overlayNotification?.addEventListener("click", closeNotificationModal);

document.addEventListener("keydown", function (e) {
  // console.log('A key was pressed');
  // console.log(e.key);
  if (e.key === "Escape" && !modal.classList.contains("hidden")) {
    closeModal();
  }
});

// admin dashboard modal functionality
const modalCustomerToDelete = document.querySelector(".modal-customer-delete");
const modalFinishDeleteCustomer = document.querySelector(
  ".modal-customer-delete-confirm"
);
const overlayCustomerToDelete = document.querySelector(
  ".overlay-customer-delete"
);
const overlayFinishedDeleteCustomer = document.querySelector(
  ".overlay-customer-delete-confirm"
);
const btnTodeleteCustomerData = document.querySelectorAll(
  ".delete-customer-data"
);
const btnCancelToDeleteCustomer = document.querySelector(
  ".cancel-delete-customer"
);
const btnConfirmToDeleteCustomer = document.querySelector(
  ".confirm-delete-customer"
);
const btnFinishedDeleteCustomer = document.querySelector(
  ".finish-delete-customer"
);

const openAndCloseModalCustomerToDelete = function () {
  modalCustomerToDelete.classList.toggle("hidden-customer-delete");
  overlayCustomerToDelete.classList.toggle("hidden-customer-delete");
};
const openAndCloseModalFinishCustomerToDelete = function () {
  modalFinishDeleteCustomer.classList.toggle("hidden-customer-delete-confirm");
  overlayFinishedDeleteCustomer.classList.toggle(
    "hidden-customer-delete-confirm"
  );
};

btnTodeleteCustomerData.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();
    openAndCloseModalCustomerToDelete();
  });
});

btnCancelToDeleteCustomer?.addEventListener(
  "click",
  openAndCloseModalCustomerToDelete
);
btnConfirmToDeleteCustomer?.addEventListener("click", () => {
  openAndCloseModalCustomerToDelete();
  openAndCloseModalFinishCustomerToDelete();
});

btnFinishedDeleteCustomer?.addEventListener(
  "click",
  openAndCloseModalFinishCustomerToDelete
);

// admin dashboard appoint modal functionalities
const modalAppointmentDelete = document.querySelector(
  ".modal-appointment-delete"
);
const modalApointmentConfirmDelete = document.querySelector(
  ".modal-appointment-delete-confirm"
);
const overlayAppointment = document.querySelector(
  ".overlay-appointment-delete"
);
const overlayConfirmAppointmentDelete = document.querySelector(
  ".overlay-appointment-delete-confirm"
);
const btnAppointmentsToDelete = document.querySelectorAll(
  ".appoint-delete-icon"
);
const cancelDeleteAppointment = document.querySelector(
  ".cancel-delete-appointment"
);
const confirmDeleteAppointment = document.querySelector(
  ".confirm-delete-appointment"
);

const btnFinishedDeleteAppoint = document.querySelector(
  ".finish-delete-appointment"
);

const openAndCloseModalAppointmentToDelete = function () {
  modalAppointmentDelete.classList.toggle("hidden-appointment-delete");
  overlayAppointment.classList.toggle("hidden-appointment-delete");
};

const openAndCloseModalConfirmAppointDelete = function () {
  modalApointmentConfirmDelete.classList.toggle(
    "hidden-appointment-delete-confirm"
  );
  overlayConfirmAppointmentDelete.classList.toggle(
    "hidden-appointment-delete-confirm"
  );
};

btnAppointmentsToDelete.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();
    openAndCloseModalAppointmentToDelete();
  });
});

cancelDeleteAppointment?.addEventListener(
  "click",
  openAndCloseModalAppointmentToDelete
);

confirmDeleteAppointment?.addEventListener("click", () => {
  openAndCloseModalAppointmentToDelete();
  openAndCloseModalConfirmAppointDelete();
});

btnFinishedDeleteAppoint?.addEventListener(
  "click",
  openAndCloseModalConfirmAppointDelete
);

// apointment to assign to customer
const modalAppointmentAssign = document.querySelector(
  ".modal-appointment-assign"
);
const overlayAppointmentAssign = document.querySelector(
  ".overlay-appointment-assign"
);
const btnOpenAssignAppointmentModal = document.querySelectorAll(
  ".appointment-to-assign"
);
const btnConfirmAppointmentAssign = document.querySelector(
  ".confirm-appointment-assign"
);

const openAndCloseAppointmentAssign = function () {
  modalAppointmentAssign.classList.toggle("hidden-appointment-assign");
  overlayAppointmentAssign.classList.toggle("hidden-appointment-assign");
};

btnOpenAssignAppointmentModal.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();
    openAndCloseAppointmentAssign();
    //
  });
});

btnConfirmAppointmentAssign?.addEventListener(
  "click",
  openAndCloseAppointmentAssign
);
overlayAppointmentAssign?.addEventListener(
  "click",
  openAndCloseAppointmentAssign
);
