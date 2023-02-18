import React from "react";
import {createRoot} from 'react-dom/client';
import { HashRouter, Route, Routes } from "react-router-dom";
import Home from "./Home/Home";



const Mainrouter = () =>{
    return(
        <HashRouter>
            <Routes>
                <Route path="/" exact element={<Home/>} />
            </Routes>
        </HashRouter>
    )
}
createRoot(document.querySelector('#root')).render(<Mainrouter/>);