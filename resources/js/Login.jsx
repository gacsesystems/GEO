import React, { useState } from "react";
import { login } from "./auth";

export default function Login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [user, setUser] = useState(null);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const u = await login(email, password);
            setUser(u);
        } catch {
            alert("Error de login");
        }
    };

    if (user) {
        return <div>Bienvenido, {user.email}</div>;
    }

    return (
        <form onSubmit={handleSubmit} className="p-4">
            <input
                type="email"
                placeholder="Email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="border p-2 block mb-2"
            />
            <input
                type="password"
                placeholder="Contraseña"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="border p-2 block mb-2"
            />
            <button type="submit" className="bg-blue-500 text-white px-4 py-2">
                Iniciar sesión
            </button>
        </form>
    );
}
