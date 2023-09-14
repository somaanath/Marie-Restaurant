import { Routes, Route } from "react-router";
import GeneratePassword from "./pages/Login/GeneratePassword";
import Login from "./pages/Login/Login";
import Dashboard from "./Dashboard/Dashboard";
import PageNotFound from "./pages/PageNotFound";
import Registration from "./pages/Registration/Registration";
import RegistrationContext from "./pages/Registration/RegistrationContext";

// import Sidebar from "./Components/Sidebar/Sidebar";
// import Home from './Dashboard/DashboardComponent/Home'
// import People from "./Dashboard/DashboardComponent/People";
// import Ingredients from "./Dashboard/DashboardComponent/Ingredients";
// import Overheads from "./Dashboard/DashboardComponent/Overheads";

function App() {
  return (
    <div>
      <Routes>
        <Route path="/generatepassword/:id" element={<GeneratePassword />} />
        <Route path="/" element={<Login />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route
          path="/registration"
          element={
            <RegistrationContext>
              <Registration />
            </RegistrationContext>
          }
        />
        <Route path="*" element={<PageNotFound />} />

        {/* <Route path="/dashboard" >
              <Route index element={<Dashboard/>} />
              <Route path="home" element={<Home/>}/>
              <Route path="People" element={<People/>} />
              <Route path="ingredients" element={<Ingredients/>} />
              <Route path="overheads" element={<Overheads/>} />
            </Route> */}
      </Routes>
    </div>
  );
}

export default App;
