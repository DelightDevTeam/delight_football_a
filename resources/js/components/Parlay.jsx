import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom/client";

import axios from "axios";

function Example() {
    const [parlays, setParlays] = useState([]);

    useEffect(() => {
        axios.get("/api/v1/markets").then((res) => {
            setParlays(res.data.data.markets);
        });
    }, []);

    console.log(parlays);

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        {parlays.map((parlay) => {
                            return (
                                <div>
                                    <h5>{parlay.name}</h5>
                                </div>
                            );
                        })}
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById("app")) {
    const Index = ReactDOM.createRoot(document.getElementById("app"));

    Index.render(
        <React.StrictMode>
            <Example />
        </React.StrictMode>
    );
}
