
import { Switch, Route, Redirect } from "react-router-dom";
import Home from "./pages/Home";
import Parents from "./pages/parent/Parents";
import Forum from "./pages/parent/AddParent";
import AddStudent from "./pages/student/AddStudent";
import SignIn from "./pages/authentification/SignIn";
import Main from "./components/layout/Main";
import Students from "./pages/student/Students"
import "antd/dist/antd.css";
import "./assets/styles/main.css";
import "./assets/styles/responsive.css";
import { useEffect, useState } from "react";

function App() {

  const [isLoggedIn, setIsLoggedIn] = useState(
    () => localStorage.getItem('logged_user') !== null
  );

  useEffect(() => {
    localStorage.setItem('logged_user', JSON.stringify(isLoggedIn));
  }, [isLoggedIn]);

  
  const logIn = () => setIsLoggedIn(true);

  // pass this callback to components you want to allow logging out
  // it will update the local state and then get persisted
  const logOut = () => setIsLoggedIn(false);

  return (
    <div className="App">
      <Switch>
        <Route path="/sign-in" exact component={SignIn} />
        <Main>
          <Route exact path="/dashboard" component={Home} />
          <Route exact path="/parents" component={Parents} />
          <Route exact path="/students" component={Students} />
          <Route exact path="/students/Forum" component={AddStudent} />
          
          <Route exact path="/parent/Forum" component={Forum} />
          <Redirect from="*" to="/dashboard" />
        </Main>
      </Switch>
    </div>
  );
}

export default App;
