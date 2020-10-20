selectCarrera = (elem) => {
    document.getElementById('carrera').value = elem.value;
    enableMaterias()
}

enableMaterias = () => {
    document.getElementById('materias_div').classList.remove('disabled')
}

selectMateria = () => {
    document.getElementById('materia').value = elem.value;
}
