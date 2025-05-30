import axios from "axios";

// 1) Configurar para que axios envíe cookies CSRF
axios.defaults.withCredentials = true;

export async function login(email, password) {
    // a) Obtener cookie XSRF
    await axios.get("/sanctum/csrf-cookie");
    // b) Llamar login
    const res = await axios.post("/api/login", { email, password });
    // c) Guardar token para usarlo en futuras solicitudes
    axios.defaults.headers.common["Authorization"] = `Bearer ${res.data.token}`;
    return res.data.user;
}
