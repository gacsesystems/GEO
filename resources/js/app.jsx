import React from "react";
import { createRoot } from "react-dom/client";
import Login from "./Login";
import "../css/app.css";

const root = createRoot(document.getElementById("app"));
root.render(<Login />);
