import React from "react";
import { createRoot } from "react-dom/client";
import Show from '../js/Show/Show';
import {HashRouter,Route,Routes} from 'react-router-dom';

const Mainrouter = () =>{
    return(
        <HashRouter>
           <Routes>
            <Route path="/" element={<Show/>} />
           </Routes>
        </HashRouter>
    )
}
createRoot(document.querySelector('#show')).render(<Mainrouter/>);