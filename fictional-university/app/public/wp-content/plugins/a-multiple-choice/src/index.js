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
      <>
        {/* <input type="text" placeholder="X" value={props.attributes.x} onChange={updateX} />
        <input type="text" placeholder="Y" value={props.attributes.y} onChange={updateY} /> */}
        <TextControl label="Question:" />
        
      </>
    );
  }