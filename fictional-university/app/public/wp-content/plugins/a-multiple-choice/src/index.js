import "./index.scss";
import {TextControl} from "@wordpress/components";


wp.blocks.registerBlockType("ourplugin/a-multiple-choice",{
  title: "Are You Making Choice?",
  icon: "list-view",
  category: "common",
  attributes:{
    x: {type:'string'},
    y: {type:'string'},
  },
  edit: EditComponent,
  save: function (props){
    return null;
  }

});

function EditComponent (props){
    function updateX(e){
      props.setAttributes({x: e.target.value});
    }
    function updateY(e){
      props.setAttributes({y: e.target.value});
    }
    return(
      <div className="a-multiple-choice-edit-block">

        <TextControl label="Question:" />
        
      </div>
    );
  }