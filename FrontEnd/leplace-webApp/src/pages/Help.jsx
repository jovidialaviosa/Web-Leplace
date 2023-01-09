import React from "react";
import Home from "../components/Home";
import Header from "../components/Header";

const Help = () => {
  return (
    <>
      <div className="flex">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Help" />
          
        </div>
      </div>
    </>
  );
};

export default Help;
