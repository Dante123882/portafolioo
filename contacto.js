const contactos = {
    dante: {
        nombre: "Dante Kaleb Rodriguez Flores",
        rol: "Desarrollador de Software en formación",
        bio: `Estudiante de Ingeniería en Desarrollo de Software Multiplataforma en la Universidad Tecnológica de Coahuila. Me considero una persona responsable, apasionada por la tecnología, 
                la arquitectura de software y el aprendizaje continuo de nuevos lenguajes 
                como PHP, JavaScript y C#.`,
        email: "danterodzflores@gmail.com"
    },
    carla: {
        nombre: "Carla Monserrat Vazquez Magallanes",
        rol: "Desarrollador de Software en formación",
        bio: `Estudiante de Ingeniería en Desarrollo de Software Multiplataforma en la Universidad Tecnológica de Coahuila. Me considero una persona responsable, apasionada por la tecnología, 
                la arquitectura de software y el aprendizaje continuo de nuevos lenguajes 
                como PHP, JavaScript y C#.`,
        email: "vazquezcarla159@gmail.com"
    }
};

const select = document.getElementById("contactoSelect");

select.addEventListener("change", () => {
    const c = contactos[select.value];

    document.getElementById("nombrePerfil").textContent = c.nombre;
    document.getElementById("rolPerfil").textContent = c.rol;
    document.getElementById("bioPerfil").textContent = c.bio;
    document.getElementById("correoDestino").value = c.email;
});