import React from 'react';
import ReactDOM from 'react-dom';


import "./frontend.scss";

const divsToUpdate = document.querySelectorAll(".multiple-choice-update-me");
alert('hi');
console.log('React:', React);
console.log('ReactDOM:', ReactDOM);

divsToUpdate.forEach((div)=>{

  ReactDOM.render(<Quiz />, div);
  div.classList.remove("multiple-choice-update-me");
});

function Quiz(){
  return (
    <div className="multiple-choice-frontend">
      Hello form React
    </div>
  );
}
