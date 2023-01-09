import React, { useState, createContext, useContext } from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import PrivateRoutes from "./utils/PrivateRoutes";
import Register from "./auth/Register";
import Login from "./auth/Login";
import Dashboard from "./pages/Dashboard";
import DetailsTugas from "./pages/DetailsTugas";
import Help from "./pages/Help";
import InputMateri from "./pages/InputMateri";
import InputTugas from "./pages/InputTugas";
import Materi from "./pages/Materi";
import Profile from "./pages/Profile";
import Tugas from "./pages/Tugas";
import TugasMahasiswa from "./pages/TugasMahasiswa";

export const UserContext = createContext(null);
const App = () => {
  const [user, setUser] = useState(false);
  return (
    <UserContext.Provider value={{ user, setUser }}>
      <Routes>
        <Route element={<PrivateRoutes />}>
          <Route exact path="/" element={<Dashboard />} />
          <Route path="/profile" element={<Profile />} />
          <Route path="/tugas" element={<Tugas />} />
          <Route path="/inputTugas" element={<InputTugas />} />
          <Route path="/materi" element={<Materi />} />
          <Route path="/inputMateri" element={<InputMateri />} />
          <Route path="/tugasMahasiswa" element={<TugasMahasiswa />} />
          <Route path="/details/:mhsId" element={<DetailsTugas />} />
          <Route path="/help" element={<Help />} />
        </Route>

        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes>
    </UserContext.Provider>
  );
};

export default App;
