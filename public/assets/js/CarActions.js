function deleteCar(id){
    const myModal = new bootstrap.Modal(document.getElementById('deleteCar'));
    inputId = document.getElementById('idCar');
    myModal.show();
    inputId.value = id;
}

function updateCar(id,matricule,marque){
    const myModalUp = new bootstrap.Modal(document.getElementById('updateCar'));
    inputId = document.getElementById('idUp');
    inputMatricule = document.getElementById('matriculeUp');
    inputMarque = document.getElementById('marqueUp');
    myModalUp.show();
    inputId.value = id;
    inputMatricule.value = matricule;
    inputMarque.value = marque;
}
